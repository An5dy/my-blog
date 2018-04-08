<?php

namespace App\Services;

use Parsedown;
use Illuminate\Http\Request;
use App\Events\ArticleCheck;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Eloquent\TagRepositoryEloquent as TagRepository;
use App\Repositories\Eloquent\ArticleRepositoryEloquent as ArticleRepository;

class ArticleService
{
    protected $articleRepository;

    protected $tagRepository;

    protected $attributes = [];

    protected $columns = [
        'id', 'category_id', 'title', 'checked_num', 'created_at', 'updated_at'
    ];

    protected $orderBy = 'checked_num';

    /**
     * ArticleService constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * 获取列表
     *
     * @return mixed
     */
    public function get()
    {
        $articles = $this->articleRepository
                         ->with([
                             'category' => function($query) {
                                return $query->select('id', 'title');
                             },
                             'tags' => function($query) {
                                return $query->select('tags.id', 'article_id', 'title');
                             }
                         ])
                         ->orderBy('id', 'desc')
                         ->paginate(null, $this->columns);

        return $articles;
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return mixed
     */
    public function getByWhere(Request $request)
    {
        $this->columns[] = 'description';
        if (isset($request->orderBy)) { $this->orderBy = $request->orderBy; }
        $articles = $this->articleRepository
                         ->with([
                             'category' => function($query) {
                                return $query->select('id', 'title');
                             },
                             'tags' => function($query) {
                                return $query->select('tags.id', 'article_id', 'title');
                             }
                         ])
                         ->scopeQuery(function ($query) use ($request){
                             return $query->title($request->title);
                         })
                         ->orderBy($this->orderBy, 'desc')
                         ->paginate(null, $this->columns);
        $this->handleArticle($articles->items());

        return $articles;
    }

    /**
     * 发布文章
     *
     * @param Request $request
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function createOrUpdate(Request $request, $id = 0)
    {
        $this->attributes = [
            'title' => strip_tags($request->title),
            'markdown' => $request->markdown,
            'description' => Parsedown::instance()
                                      ->setMarkupEscaped(true)
                                      ->text($request->markdown),
            'category_id' => $request->category,
        ];
        $article = $this->articleRepository->createOrUpdate($this->attributes, $id);

        // 清除标记缓存缓存
        flush_cache_by_tag('articles');
        flush_cache_by_key('article:' . $article->id);

        return api_success_info('发布成功');
    }

    /**
     * 详情
     *
     * @param $id
     * @param string $filed
     * @return mixed
     */
    public function find($id, $filed = 'markdown')
    {
        $this->columns[] = $filed;
        $cacheKey = 'article:' . $id;
        $minutes = config('global.cacheArticle');
        $article = Cache::remember($cacheKey, $minutes, function () use ($id) {
            return $this->findById($id);
        });

        return $article;
    }

    /**
     * 获取文章详情
     *
     * @param $id
     * @return mixed
     * @throws ApiException
     */
    public function findById($id)
    {
        try {
            $article = $this->articleRepository
                            ->with([
                                'category' => function($query) {
                                    return $query->select('id', 'title');
                                },
                                'tags' => function($query) {
                                    return $query->select('tags.id', 'article_id', 'title');
                                }
                            ])
                            ->find($id, $this->columns);
            // 格式化时间
            if ( ! in_array('markdown', $this->columns)) {
                $article->published_at = $article->created_at->toFormattedDateString();
            }

            return $article;
        } catch (\Exception $exception) {
            throw new ApiException('当前文章不存在');
        }
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function destroy($id)
    {
        try {
            $this->articleRepository->delete($id);

            flush_cache_by_tag('articles');

            return api_success_info('删除成功');
        } catch (\Exception $exception) {

            throw new ApiException('删除失败');
        }
    }

    /**
     * 归档
     *
     * @return mixed
     */
    public function archive()
    {
        // 设置缓存
        $articles = Cache::tags(['articles', 'archives'])->rememberForever('archives', function () {
            // 获取数据
            return $this->articleRepository
                        ->orderBy('created_at', 'desc')
                        ->get(['id', 'title', 'created_at'])
                        ->each(function ($article) {
                            $article->published_at = $article->created_at->format('M Y');
                        })
                        ->groupBy('published_at');
        });

        return $articles;
    }

    /**
     * 设置文章列表详情显示字数及高亮提示
     *
     * @param $articles
     */
    protected function handleArticle($articles)
    {
        if (! $articles instanceof Collection) {
            $articles = collect($articles);
        }
        $title = request('title');
        $articles->each(function ($article) use ($title){
            // 标签过滤
            $article->description = strip_tags($article->description);
            // 列表展示字数
            $article->description = str_limit($article->description, config('global.article.limit'));
            // 标记搜索字段
            if (! empty($title)) {
                $arr = explode($title, $article->title);
                $article->title = implode('<em style="color:#409eff">' . $title . '</em>', $arr);
            }
        });
    }
}
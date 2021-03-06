<?php
declare(strict_types = 1);

namespace App\Services;

use Parsedown;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Events\ArticleCheck;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Eloquent\ArticleRepositoryEloquent as ArticleRepository;

class ArticleService
{
    protected $articleRepository;

    protected $attributes = [];

    protected $columns = [
        'id', 'category_id', 'title', 'checked_num', 'created_at', 'updated_at'
    ];

    protected $orderBy = 'checked_num';

    /**
     * 注入ArticleRepository
     *
     * ArticleService constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return mixed
     */
    public function getByWhereWithRelationship(Request $request):LengthAwarePaginator
    {
        $boolean = is_admin_prefix();

        // 前台返回 description 字段
        if ( ! $boolean) {
            $this->columns[] = 'description';
        }

        // 设置查询排序
        if ($boolean) {
            $this->orderBy = 'id';
        } elseif (isset($request->orderBy)) {
            $this->orderBy = 'created_at';
        }

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

        // 设置前台搜索字段标记
        if (! $boolean) {
            $this->handleArticle($articles->items());
        }

        return $articles;
    }

    /**
     * 发布或修改文章
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function createOrUpdate(Request $request, $id = 0):array
    {
        $this->attributes = [
            'title'         => strip_tags($request->title),
            'markdown'      => $request->markdown,
            'description'   => Parsedown::instance()
                                        ->setMarkupEscaped(true)
                                        ->text($request->markdown),
            'category_id'   => $request->category,
        ];

        $article = $this->articleRepository->createOrUpdate($this->attributes, $id);

        // 清除标记缓存缓存
        flush_cache_by_tag('articles');
        flush_cache_by_key('article:' . $article->id);

        return api_success_info('发布成功');
    }

    /**
     * 获取文章详情
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $boolean = is_admin_prefix();
        // 后台不使用缓存
        if ($boolean) {
            $this->columns[] = 'markdown';
            $article = $this->findByIdWithRelationship($id);
        } else {
            $this->columns[] = 'description';
            $cacheKey = 'article:' . $id;
            $minutes = config('global.cacheArticle');
            $article = Cache::remember($cacheKey, $minutes, function () use ($id) {
                return $this->findByIdWithRelationship($id);
            });
        }

        return $article;
    }

    /**
     * 文章详情
     *
     * @param $id
     * @return mixed
     */
    public function findByIdWithRelationship($id):Article
    {
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
            // 浏览事件
            event(new ArticleCheck($article));
        }

        return $article;
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function destroy($id):array
    {
        $this->articleRepository->delete($id);

        // 清除缓存
        flush_cache_by_tag('articles');
        flush_cache_by_key('article:' . $id);

        return api_success_info('删除成功');
    }

    /**
     * 归档
     *
     * @return mixed
     */
    public function archive():Collection
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
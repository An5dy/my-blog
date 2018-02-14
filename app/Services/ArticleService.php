<?php

namespace App\Services;

use App\Events\ArticleCheck;
use DB;
use Parsedown;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Repositories\TagRepository;
use App\Repositories\ArticleRepository;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleService
{
    protected $articleRepository;

    protected $tagRepository;

    protected $attributes = [];

    protected $columns = ['id', 'category_id', 'title', 'checked_num', 'created_at', 'updated_at'];

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
     * @return ArticleCollection
     */
    public function index()
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

        return new ArticleCollection($articles);
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return ArticleCollection
     */
    public function list(Request $request)
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

        return new ArticleCollection($articles);
    }

    /**
     * 发布文章
     *
     * @param Request $request
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function store(Request $request, $id = 0)
    {
        $this->attributes = [
            'title' => strip_tags($request->title),
            'markdown' => $request->markdown,
            'description' => Parsedown::instance()
                                      ->setMarkupEscaped(true)
                                      ->text($request->markdown),
            'category_id' => $request->category,
        ];
        DB::beginTransaction();
        try {
            if (empty($id)) {
                $article = $this->articleRepository
                                ->create($this->attributes);
            } else {
                $article = $this->articleRepository
                                ->update($this->attributes, $id);
            }
            /* 标签 */
            $tags = collect($request->tags)->map(function ($tag) {
                $tagObj = $this->tagRepository
                               ->firstOrCreate(['title' => strip_tags($tag)]);
                return $tagObj->id;
            })->toArray();
            $article->tags()
                    ->sync($tags);
            DB::commit();

            return api_success_info('发布成功');
        } catch (\Exception $exception) {
            DB::rollback();

            throw new ApiException('发布失败');
        }
    }

    /**
     * 详情
     *
     * @param $id
     * @param string $filed
     * @return ArticleResource
     * @throws ApiException
     */
    public function find($id, $filed = 'markdown')
    {
        try {
            $this->columns[] = $filed;
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
            $article->published_at = $article->created_at
                                             ->toFormattedDateString();
            // 文章查看事件
            if ($filed != 'markdown') { event(new ArticleCheck($article)); }

            return new ArticleResource($article);
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
            $this->articleRepository
                 ->delete($id);

            return api_success_info('删除成功');
        } catch (\Exception $exception) {

            throw new ApiException('删除失败');
        }
    }

    /**
     * 归档
     *
     * @return ArticleCollection
     */
    public function archive()
    {
        $articles = $this->articleRepository
                         ->orderBy('created_at', 'desc')
                         ->get(['id', 'title', 'created_at'])
                         ->each(function ($article) {
                             $article->published_at = $article->created_at
                                                              ->format('M Y');
                         })
                         ->groupBy('published_at');

        return new ArticleCollection($articles);
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
<?php

namespace App\Http\Controllers\Web;

use App\Services\ArticleService;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    protected $articleService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * 文章列表
     *
     * @param SearchRequest $request
     * @return ArticleCollection
     */
    public function index(SearchRequest $request)
    {
        $articles = $this->articleService->getByWhereWithRelationship($request);

        return new ArticleCollection($articles);
    }

    /**
     * 文章详情
     *
     * @param $id
     * @return ArticleResource
     */
    public function show($id)
    {
        $article = $this->articleService->find($id, 'description');

        return new ArticleResource($article);
    }
}

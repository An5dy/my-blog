<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    protected $articleService;

    /**
     * 注入ArticleService
     *
     * ArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->articleService->getByWhereWithRelationship($request);

        return new ArticleCollection($articles);
    }

    /**
     * 保存
     *
     * @param ArticleRequest $request
     * @return array
     */
    public function store(ArticleRequest $request)
    {
        $response = $this->articleService->createOrUpdate($request);

        return $response;
    }

    /**
     * 编辑
     *
     * @param $id
     * @return ArticleResource
     */
    public function edit($id)
    {
        $article = $this->articleService->find($id);

        return new ArticleResource($article);
    }

    /**
     * 编辑
     *
     * @param ArticleRequest $request
     * @param $id
     * @return array
     */
    public function update(ArticleRequest $request, $id)
    {
        $response = $this->articleService->createOrUpdate($request, $id);

        return $response;
    }

    /**
     * 删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->articleService->destroy($id);

        return $response;
    }
}

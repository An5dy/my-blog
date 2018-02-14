<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;

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
     * 列表
     *
     * @param Request $request
     * @return \App\Http\Resources\ArticleCollection
     */
    public function list(Request $request)
    {
        $response = $this->articleService
                         ->list($request);

        return $response;
    }

    /**
     * 文章详情
     *
     * @param $id
     * @return \App\Http\Resources\ArticleResource
     */
    public function show($id)
    {
        $response = $this->articleService
                         ->find($id, 'description');

        return $response;
    }
}

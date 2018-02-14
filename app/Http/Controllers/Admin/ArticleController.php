<?php

namespace App\Http\Controllers\Admin;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->articleService
                         ->index();

        return $response;
    }

    /**
     * 保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->articleService
                         ->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 编辑
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = $this->articleService
                         ->find($id);

        return $response;
    }

    /**
     * 编辑
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->articleService
                         ->store($request, $id);

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
        $response = $this->articleService
                         ->destroy($id);

        return $response;
    }
}

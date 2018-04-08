<?php

namespace App\Http\Controllers\Admin;

use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    protected $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->index();

        return new CategoryCollection($categories);
    }

    /**
     * 所有分类
     *
     * @return \App\Http\Resources\CategoryCollection
     */
    public function list()
    {
        $categories = $this->categoryService->list();

        return new CategoryCollection($categories);
    }

    /**
     * 保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $response = $this->categoryService->createOrUpdate($request);

        return $response;
    }

    /**
     * 修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $response = $this->categoryService->createOrUpdate($request, $id);

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
        $response = $this->categoryService->delete($id);

        return $response;
    }
}

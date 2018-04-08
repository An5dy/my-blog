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
     * 注入CategoryService
     *
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * 列表分页
     *
     * @return CategoryCollection
     */
    public function index()
    {
        $categories = $this->categoryService->index();

        return new CategoryCollection($categories);
    }

    /**
     * 所有分类
     *
     * @return CategoryCollection
     */
    public function list()
    {
        $categories = $this->categoryService->list();

        return new CategoryCollection($categories);
    }

    /**
     * 保存
     *
     * @param CategoryRequest $request
     * @return array
     */
    public function store(CategoryRequest $request)
    {
        $response = $this->categoryService->createOrUpdate($request);

        return $response;
    }

    /**
     * 修改
     *
     * @param CategoryRequest $request
     * @param $id
     * @return array
     */
    public function update(CategoryRequest $request, $id)
    {
        $response = $this->categoryService->createOrUpdate($request, $id);

        return $response;
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $response = $this->categoryService->delete($id);

        return $response;
    }
}

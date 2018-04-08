<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\CategoryRepositoryEloquent as CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    protected $attributes = [];

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 获取列表
     *
     * @return CategoryResource
     */
    public function index()
    {
        $categories = $this->categoryRepository->paginate(null, [
            'id', 'title', 'created_at', 'updated_at'
        ]);

        return $categories;
    }

    /**
     * 分类列表
     *
     * @return CategoryCollection
     */
    public function list()
    {
        $categories = $this->categoryRepository->all(['id', 'title']);

        return $categories;
    }

    /**
     * 添加或修改分类
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function createOrUpdate(Request $request, $id = 0)
    {
        $this->attributes = ['title' => $request->title];

        $this->categoryRepository->createOrUpdate($this->attributes, $id);

        return api_success_info('添加成功');
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $this->categoryRepository->delete($id);

        return api_success_info('删除成功');
    }
}
<?php

namespace App\Services;

use App\Http\Resources\CategoryCollection;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Repositories\CategoryRepository;
use App\Http\Resources\CategoryResource;

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
        $categories = $this->categoryRepository
                           ->paginate(null, ['id', 'title', 'created_at', 'updated_at']);

        return new CategoryCollection($categories);
    }

    /**
     * 分类列表
     *
     * @return CategoryCollection
     */
    public function list()
    {
        $categories = $this->categoryRepository->all(['id', 'title']);

        return new CategoryCollection($categories);
    }

    /**
     * 添加分类
     *
     * @param Request $request
     * @param int $id
     * @return array
     * @throws ApiException
     */
    public function store(Request $request, $id = 0)
    {
        $this->attributes = [
            'title' => $request->title,
        ];
        try {
            if (empty($id)) {
                $this->categoryRepository
                     ->create($this->attributes);
            } else {
                $this->categoryRepository
                     ->update($this->attributes, $id);
            }

            return api_success_info('添加成功');
        } catch (\Exception $exception) {

            throw new ApiException('添加失败');
        }
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function delete($id)
    {
        try {
            $this->categoryRepository->delete($id);

            return api_success_info('删除成功');
        } catch (\Exception $exception) {

            throw new ApiException('删除失败');
        }
    }
}
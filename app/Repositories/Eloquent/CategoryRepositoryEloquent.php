<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Validators\CategoryValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\CategoryRepository;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 新增或更新
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     * @throws
     */
    public function createOrUpdate(array $attributes, $id = 0)
    {
        $model = empty($id) ? $this->create($attributes) : $this->update($attributes, $id);

        return $model;
    }
}

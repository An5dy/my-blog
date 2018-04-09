<?php

namespace App\Repositories\Eloquent;

use App\Models\About;
use App\Validators\AboutValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\AboutRepository;

class AboutRepositoryEloquent extends BaseRepository implements AboutRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return About::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 保存或修改
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function createOrUpdate(array $attributes, $id = 0)
    {
        $model = empty($id) ? $this->create($attributes) : $this->update($attributes, $id);

        return $model;
    }
}

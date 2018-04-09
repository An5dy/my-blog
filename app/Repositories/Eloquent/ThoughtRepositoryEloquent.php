<?php

namespace App\Repositories\Eloquent;

use App\Models\Thought;
use App\Validators\ThoughtValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ThoughtRepository;

class ThoughtRepositoryEloquent extends BaseRepository implements ThoughtRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Thought::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 新增或修改
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

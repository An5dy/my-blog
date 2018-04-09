<?php

namespace App\Repositories\Eloquent;

use App\Models\Link;
use App\Validators\LinkValidator;
use App\Contracts\Repositories\LinkRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class LinkRepositoryEloquent extends BaseRepository implements LinkRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Link::class;
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
     */
    public function createOrUpdate(array $attributes, $id = 0)
    {
        $model = empty($id) ? $this->create($attributes) : $this->update($attributes, $id);

        return $model;
    }
}

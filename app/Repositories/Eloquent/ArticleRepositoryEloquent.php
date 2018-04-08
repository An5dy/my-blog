<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Article;
use App\Validators\ArticleValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ArticleRepository;

class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 保存或修改文章
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function createOrUpdate(array $attributes, $id = 0)
    {
        DB::beginTransaction();

        try {
            $model = empty($id) ? $this->create($attributes) : $this->update($attributes, $id);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            throw $exception;
        }

        return $model;
    }
}

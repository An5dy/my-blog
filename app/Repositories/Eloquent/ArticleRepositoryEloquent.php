<?php

namespace App\Repositories\Eloquent;

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
     * 保存或修改文章及所属标签
     *
     * @param array $attributes
     * @param array $tags
     * @param int $id
     * @return mixed
     */
    public function createOrUpdateWithTags(array $attributes, array $tags, $id = 0)
    {
        $model = empty($id) ? $this->create($attributes) : $this->update($attributes, $id);

        // 保存标签
        $tagIds = collect($tags)->map(function ($tag) use ($model) {
            $tagModel = $model->tags()->firstOrCreate(['title' => strip_tags($tag)]);

            return $tagModel->id;
        })->toArray();

        $model->tags()->sync($tagIds);
        $this->resetModel();

        return $this->parserResult($model);
    }
}

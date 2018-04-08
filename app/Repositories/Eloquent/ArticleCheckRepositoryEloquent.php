<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ArticleCheckRepository;
use App\Models\ArticleCheck;
use App\Validators\ArticleCheckValidator;

/**
 * Class ArticleCheckRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ArticleCheckRepositoryEloquent extends BaseRepository implements ArticleCheckRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ArticleCheck::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

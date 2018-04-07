<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\AboutRepository;
use App\Models\About;
use App\Validators\AboutValidator;

/**
 * Class AboutRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
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
    
}

<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ThoughtRepository;
use App\Models\Thought;
use App\Validators\ThoughtValidator;

/**
 * Class ThoughtRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
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
    
}

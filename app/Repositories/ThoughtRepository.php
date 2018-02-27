<?php

namespace App\Repositories;

use App\Models\Thought;
use Prettus\Repository\Eloquent\BaseRepository;

class ThoughtRepository extends BaseRepository
{
    public function model()
    {
        return Thought::class;
    }
}
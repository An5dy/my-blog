<?php

namespace App\Repositories;

use App\Models\About;
use Prettus\Repository\Eloquent\BaseRepository;

class AboutRepository extends BaseRepository
{
    public function model()
    {
        return About::class;
    }
}
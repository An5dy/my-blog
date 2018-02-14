<?php

namespace App\Repositories;

use App\Models\Link;
use Prettus\Repository\Eloquent\BaseRepository;

class LinkRepository extends BaseRepository
{
    public function model()
    {
        return Link::class;
    }
}
<?php

namespace App\Repositories;

use App\Models\ArticleCheck;
use Prettus\Repository\Eloquent\BaseRepository;

class ArticleCheckRepository extends BaseRepository
{
    public function model()
    {
        return ArticleCheck::class;
    }
}
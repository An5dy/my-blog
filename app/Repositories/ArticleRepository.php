<?php

namespace App\Repositories;

use App\Models\Article;
use Prettus\Repository\Eloquent\BaseRepository;

class ArticleRepository extends BaseRepository
{
    public function model()
    {
        return Article::class;
    }
}
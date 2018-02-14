<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCheck extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'article_id', 'visitor'
    ];
}

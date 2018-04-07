<?php

namespace App\Models\Relationships;

trait HasManyArticleChecks
{
    public function articleChecks()
    {
        return $this->hasMany('App\Models\ArticleCheck');
    }
}
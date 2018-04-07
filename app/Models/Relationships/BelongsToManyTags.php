<?php

namespace App\Models\Relationships;

trait BelongsToManyTags
{
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
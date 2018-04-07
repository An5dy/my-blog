<?php

namespace App\Models\Relationships;

trait BelongsToCategory
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
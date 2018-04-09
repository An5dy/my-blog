<?php

namespace App\Models\Scopes;

trait ScopeTitle
{
    public function scopeTitle($query, $title)
    {
        return isset($title) ? $query->where('title', 'like', $title . '%') : $query;
    }
}
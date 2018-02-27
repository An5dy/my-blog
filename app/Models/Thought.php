<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thought extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'markdown'
    ];
}

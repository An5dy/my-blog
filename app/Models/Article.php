<?php

namespace App\Models;

use App\Events\ArticleSaved;
use App\Models\Scopes\ScopeTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use App\Models\Relationships\BelongsToCategory;
use App\Models\Relationships\BelongsToManyTags;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\Relationships\HasManyArticleChecks;

class Article extends Model implements Transformable
{
    use TransformableTrait,
        SoftDeletes,
        BelongsToManyTags,
        BelongsToCategory,
        HasManyArticleChecks,
        ScopeTitle;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'title', 'description', 'markdown', 'checked_num'
    ];

    /**
     * 绑定事件
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => ArticleSaved::class,
    ];
}

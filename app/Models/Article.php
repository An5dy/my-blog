<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use App\Models\Relationships\BelongsToCategory;
use App\Models\Relationships\BelongsToManyTags;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\Relationships\HasManyArticleChecks;

/**
 * Class Article.
 *
 * @package namespace App\Models;
 */
class Article extends Model implements Transformable
{
    use TransformableTrait,
        SoftDeletes,
        BelongsToManyTags,
        BelongsToCategory,
        HasManyArticleChecks;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'title', 'description', 'markdown', 'checked_num'
    ];

    /**
     * 搜索标题scope
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public function scopeTitle($query, $title)
    {
        return isset($title) ? $query->where('title', 'like', '%' . $title . '%') : $query;
    }
}

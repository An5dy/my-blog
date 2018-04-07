<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'title', 'description', 'markdown', 'checked_num'
    ];

    /**
     * 文章所属分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * 文章所属标签
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * 文章查看次数
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checks()
    {
        return $this->hasMany('App\Models\ArticleCheck');
    }

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

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ArticleCheck' => [
            'App\Listeners\Articles\AddCheckedNum',// 增加文章浏览量事件
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'App\Listeners\Auth\RevokeOldTokens',
        ],
        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'App\Listeners\Auth\PruneOldTokens',
        ],
        'App\Events\ArticleSaved' => [
            'App\Listeners\Articles\SaveTags',// 保存文章标签事件
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

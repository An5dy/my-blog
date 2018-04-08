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
            'App\Listeners\Articles\UpdateArticleCheck',
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'App\Listeners\Auth\RevokeOldTokens',
        ],
        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'App\Listeners\Auth\PruneOldTokens',
        ],
        'App\Events\ArticleSaved' => [
            'App\Listeners\Articles\SaveTags',
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

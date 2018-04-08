<?php

namespace App\Listeners\Articles;

use App\Events\ArticleSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveTags
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticleSaved  $event
     * @return void
     */
    public function handle(ArticleSaved $event)
    {
        $article = $event->article;
        $tags = request('tags');
        $tagIds = collect($tags)->map(function ($tag) use ($article) {
            $tagModel = $article->tags()->firstOrCreate(['title' => strip_tags($tag)]);

            return $tagModel->id;
        })->toArray();

        $article->tags()->sync($tagIds);
    }
}

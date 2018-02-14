<?php

namespace App\Listeners\Articles;

use App\Events\ArticleCheck;
use App\Services\ArticleCheckService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateArticleCheck
{
    protected $articleCheckService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ArticleCheckService $articleCheckService)
    {
        $this->articleCheckService = $articleCheckService;
    }

    /**
     * Handle the event.
     *
     * @param  ArticleCheck  $event
     * @return void
     */
    public function handle(ArticleCheck $event)
    {
        // 增加文章查看数
        $event->article
              ->increment('checked_num');
        // 记录查看的用户
        $this->articleCheckService
             ->add($event->article->id);
    }
}

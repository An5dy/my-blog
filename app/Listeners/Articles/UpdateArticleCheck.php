<?php

namespace App\Listeners\Articles;

use DB;
use App\Events\ArticleCheck;
use App\Services\ArticleCheckService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateArticleCheck
{
    protected $articleCheckService;

    protected $article;

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
     * @param  ArticleCheck  $event
     * @return void
     */
    public function handle(ArticleCheck $event)
    {
        $this->article = $event->article;

        $this->updateChecked();
    }

    /**
     * 更新文章浏览信息
     */
    protected function updateChecked()
    {
        DB::transaction(function () {
            // 增加浏览次数
            $this->article->increment('checked_num');
            // 增加浏览记录
            $this->article->checks()
                          ->firstOrCreate([
                              'article_id' => $this->article->id,
                              'visitor' => request()->ip(),
                          ]);
        });
    }
}

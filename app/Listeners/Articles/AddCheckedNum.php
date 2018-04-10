<?php

namespace App\Listeners\Articles;

use Redis;
use App\Events\ArticleCheck;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddCheckedNum
{
    /**
     * 文章实例
     *
     * @var
     */
    protected $article;

    /**
     * 文章锁key
     *
     * @var
     */
    protected $articleIdLock;

    /**
     * 访问用户锁key
     *
     * @var
     */
    protected $ipLock;

    /**
     * 同一用户浏览同一个帖子的过期时间
     *
     * @var
     */
    protected $ipExpireSecond;

    /**
     * 用户IP
     *
     * @var
     */
    protected $userIp;

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
        $this->userIp = request()->ip();
        $this->ipExpireSecond = config('global.cacheArticle') * 60;

        // 限制同一IP一段时间内得访问,防止增加无效浏览次数
        if ($this->isIpLimit()) {
            $this->updateArticleCheckedNum();
        }
    }

    /**
     * 限制同一IP一段时间内得访问,防止增加无效浏览次数
     *
     * @return bool
     */
    protected function isIpLimit()
    {
        $this->articleIdLock = 'article:ip:limit' . $this->article->id;
        // 判断是否有当前key
        $existed = Redis::command('SISMEMBER', [$this->articleIdLock, $this->userIp]);

        if ( ! $existed) {
            // 保存数据到集合
            Redis::command('SADD', [$this->articleIdLock, $this->userIp]);
            // 设置访问失效时间，超过设置时间就当重新访问
            Redis::command('EXPIRE', [$this->articleIdLock, $this->ipExpireSecond]);
            // 保存不同用户访问记录
            $this->article->articleChecks()
                          ->firstOrCreate([
                              'article_id' => $this->article->id,
                              'visitor' => $this->userIp,
                          ]);

            return true;
        }

        return false;
    }

    /**
     * 更新文章访问
     *
     * @param int $count
     */
    protected function updateArticleCheckedNum($count = 1)
    {
        $this->article->increment('checked_num', $count);
    }
}

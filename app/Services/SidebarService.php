<?php

namespace App\Services;

use App\Criteria\LimitCriteria;
use App\Repositories\LinkRepository;
use Illuminate\Support\Facades\Cache;
use App\Repositories\ArticleRepository;

class SidebarService
{
    protected $articleRepository;

    protected $linkRepository;

    /**
     * SidebarService constructor.
     * @param ArticleRepository $articleRepository
     * @param LinkRepository $linkRepository
     */
    public function __construct(ArticleRepository $articleRepository, LinkRepository $linkRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->linkRepository = $linkRepository;
    }

    /**
     * 侧边栏
     *
     * @return array
     */
    public function index()
    {
        // 文章
        $articles = Cache::tags(['articles', 'newest'])->rememberForever('newest', function () {
            // 设置查询条数
            $this->articleRepository->pushCriteria(new LimitCriteria(5));

            return $this->articleRepository
                        ->orderBy('created_at', 'desc')
                        ->get(['id', 'title']);
        });

        // 友情链接
        $links = Cache::tags(['links'])->rememberForever('links', function () {
            return $this->linkRepository->get(['id', 'path', 'description']);
        });

        $data = collect()->put('articles', $articles)
                         ->put('links', $links)
                         ->all();

        return api_success_info('获取成功', $data);
    }
}
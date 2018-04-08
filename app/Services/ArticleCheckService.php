<?php

namespace App\Services;

use App\Repositories\Eloquent\ArticleCheckRepositoryEloquent as ArticleCheckRepository;

class ArticleCheckService
{
    protected $articleCheckRepository;

    protected $attributes = [
        'article_id', 'visitor'
    ];

    /**
     * ArticleCheckService constructor.
     * @param ArticleCheckRepository $articleCheckRepository
     */
    public function __construct(ArticleCheckRepository $articleCheckRepository)
    {
        $this->articleCheckRepository = $articleCheckRepository;
    }

    /**
     * @param int $articleId
     * @return bool
     */
    public function add($articleId)
    {
        $this->attributes = [
            'article_id' => $articleId,
            'visitor' => request()->ip(),
        ];
        try {
            $this->articleCheckRepository
                 ->firstOrCreate($this->attributes);

            return true;
        } catch (\Exception $exception) {

            return false;
        }
    }
}
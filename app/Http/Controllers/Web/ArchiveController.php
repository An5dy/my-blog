<?php

namespace App\Http\Controllers\Web;

use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;

class ArchiveController extends Controller
{
    protected $articleService;

    /**
     * ArchiveController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * 归档
     *
     * @return mixed
     */
    public function __invoke()
    {
        $response = $this->articleService->archive();

        return new ArticleCollection($response);
    }
}

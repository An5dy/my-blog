<?php

namespace App\Http\Controllers\Web;

use App\Services\ArticleService;
use App\Http\Controllers\Controller;

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
    public function index()
    {
        $response = $this->articleService
                         ->archive();

        return $response;
    }
}

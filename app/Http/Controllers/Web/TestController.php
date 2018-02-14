<?php

namespace App\Http\Controllers\Web;

use App\Services\ArticleCheckService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    protected $articleCheckService;

    public function __construct(ArticleCheckService $articleCheckService)
    {
        $this->articleCheckService = $articleCheckService;
    }

    public function test()
    {
        $response = $this->articleCheckService->add('1');
    }
}

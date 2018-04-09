<?php

namespace App\Http\Controllers\Web;

use App\Services\AboutService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;

class AboutController extends Controller
{
    protected $aboutService;

    /**
     * 注入AboutService
     *
     * AboutController constructor.
     * @param AboutService $aboutService
     */
    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    /**
     * 关于详情
     *
     * @return \App\Http\Resources\AboutResource
     */
    public function index()
    {
        $about = $this->aboutService->show();

        return new AboutResource($about);
    }
}

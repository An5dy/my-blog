<?php

namespace App\Http\Controllers\Admin;

use App\Services\AboutService;
use App\Http\Requests\AboutRequest;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = $this->aboutService->show();

        return new AboutResource($about);
    }

    /**
     * 保存或修改
     *
     * @param AboutRequest $request
     * @return AboutResource
     */
    public function store(AboutRequest $request)
    {
        $about = $this->aboutService->createOrUpdate($request);

        return new AboutResource($about);
    }
}

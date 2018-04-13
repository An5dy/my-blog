<?php

namespace App\Http\Controllers\Web;

use App\Services\SidebarService;
use App\Http\Controllers\Controller;

class SidebarController extends Controller
{
    protected $sidebarService;

    /**
     * SidebarController constructor.
     * @param SidebarService $sidebarService
     */
    public function __construct(SidebarService $sidebarService)
    {
        $this->sidebarService = $sidebarService;
    }

    /**
     * 侧边栏数据
     */
    public function __invoke()
    {
        $response = $this->sidebarService->index();

        return $response;
    }
}

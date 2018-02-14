<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\AboutService;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    protected $aboutService;

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
        $response = $this->aboutService
                         ->show();
        return $response;
    }
}

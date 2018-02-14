<?php

namespace App\Http\Controllers\Admin;

use App\Services\AboutService;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->aboutService
                         ->index();

        return $response;
    }

    /**
     * 保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->aboutService
                         ->store($request);

        return $response;
    }
}

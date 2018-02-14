<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\LinkService;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    protected $linkService;

    /**
     * LinkController constructor.
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->linkService
                         ->index();

        return $response;
    }

    /**
     * 新增
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->linkService
                         ->store($request);

        return $response;
    }

    /**
     * 编辑
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->linkService
                         ->store($request, $id);

        return $response;
    }

    /**
     * 删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->linkService
                         ->destroy($id);

        return $response;
    }
}

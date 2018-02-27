<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\ThoughtCollection;
use App\Http\Resources\ThoughtResource;
use Illuminate\Http\Request;
use App\Services\ThoughtService;
use App\Http\Controllers\Controller;

class ThoughtController extends Controller
{
    protected $thoughtService;

    /**
     * 依赖注入ThoughtService
     *
     * ThoughtController constructor.
     * @param ThoughtService $thoughtService
     */
    public function __construct(ThoughtService $thoughtService)
    {
        $this->thoughtService = $thoughtService;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thoughts = $this->thoughtService
                         ->index();

        return new ThoughtCollection($thoughts);
    }

    /**
     * 保存随想
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thought = $this->thoughtService
                        ->createOrUpdate($request);

        return new ThoughtResource($thought);
    }

    /**
     * 详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->thoughtService
                         ->show($id);

        return new ThoughtResource($response);
    }

    /**
     * 修改随想
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thought = $this->thoughtService
                        ->createOrUpdate($request, $id);

        return new ThoughtResource($thought);
    }

    /**
     * 删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->thoughtService
             ->destroy($id);

        return api_success_info('删除成功!');
    }
}

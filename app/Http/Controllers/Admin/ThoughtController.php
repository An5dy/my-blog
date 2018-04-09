<?php

namespace App\Http\Controllers\Admin;

use App\Services\ThoughtService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThoughtRequest;
use App\Http\Resources\ThoughtResource;
use App\Http\Resources\ThoughtCollection;

class ThoughtController extends Controller
{
    protected $thoughtService;

    /**
     * 依赖注入 ThoughtService
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
     * @return ThoughtCollection
     */
    public function index()
    {
        $thoughts = $this->thoughtService->index();

        return new ThoughtCollection($thoughts);
    }

    /**
     * 保存
     *
     * @param ThoughtRequest $request
     * @return ThoughtResource
     */
    public function store(ThoughtRequest $request)
    {
        $thought = $this->thoughtService->createOrUpdate($request);

        return new ThoughtResource($thought);
    }

    /**
     * 详情
     *
     * @param $id
     * @return ThoughtResource
     */
    public function show($id)
    {
        $thought = $this->thoughtService->show($id);

        return new ThoughtResource($thought);
    }

    /**
     * 修改
     *
     * @param ThoughtRequest $request
     * @param $id
     * @return ThoughtResource
     */
    public function update(ThoughtRequest $request, $id)
    {
        $thought = $this->thoughtService->createOrUpdate($request, $id);

        return new ThoughtResource($thought);
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $response = $this->thoughtService->destroy($id);

        return $response;
    }
}

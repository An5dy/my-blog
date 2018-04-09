<?php

namespace App\Http\Controllers\Admin;

use App\Services\LinkService;
use App\Http\Requests\LinkRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinkCollection;

class LinkController extends Controller
{
    protected $linkService;

    /**
     * 注入LinkService
     *
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
     * @return LinkCollection
     */
    public function index()
    {
        $links = $this->linkService->index();

        return new LinkCollection($links);
    }

    /**
     * 新增
     *
     * @param LinkRequest $request
     * @return array
     */
    public function store(LinkRequest $request)
    {
        $response = $this->linkService->createOrUpdate($request);

        return $response;
    }

    /**
     * 编辑
     *
     * @param LinkRequest $request
     * @param $id
     * @return array
     */
    public function update(LinkRequest $request, $id)
    {
        $response = $this->linkService->createOrUpdate($request, $id);

        return $response;
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $response = $this->linkService->destroy($id);

        return $response;
    }
}

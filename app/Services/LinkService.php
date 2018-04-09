<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Resources\LinkCollection;
use App\Repositories\Eloquent\LinkRepositoryEloquent as LinkRepository;

class LinkService
{
    protected $linkRepository;

    protected $attributes = [];

    /**
     * LinkService constructor.
     * @param LinkRepository $linkRepository
     */
    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    /**
     * 获取链接列表
     *
     * @return LinkCollection
     */
    public function index()
    {
        $links = $this->linkRepository->all([
            'id', 'path', 'description', 'created_at', 'updated_at'
        ]);

        return $links;
    }

    /**
     * 添加或编辑
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function createOrUpdate(Request $request, $id = 0)
    {
        $this->attributes = [
            'path' => $request->path,
            'description' => $request->description,
        ];

        $this->linkRepository->createOrUpdate($this->attributes, $id);

        flush_cache_by_tag('links');

        return api_success_info('添加成功');
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $this->linkRepository->delete($id);

        flush_cache_by_tag('links');

        return api_success_info('删除成功');
    }
}
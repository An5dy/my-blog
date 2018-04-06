<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Repositories\LinkRepository;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\LinkCollection;

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
        $links = $this->linkRepository
                      ->all(['id', 'path', 'description', 'created_at', 'updated_at']);

        return new LinkCollection($links);
    }

    /**
     * 添加或编辑
     *
     * @param Request $request
     * @param int $id
     * @return array
     * @throws ApiException
     */
    public function store(Request $request, $id = 0)
    {
        $this->attributes = [
            'path' => $request->path,
            'description' => $request->description,
        ];
        try {
            if (empty($id)) {
                $this->linkRepository
                     ->create($this->attributes);
            } else {
                $this->linkRepository
                     ->update($this->attributes, $id);
            }

            $this->flushCache();

            return api_success_info('添加成功');
        } catch (\Exception $exception) {

            throw new ApiException('添加失败');
        }
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function destroy($id)
    {
        try {
            $this->linkRepository
                 ->delete($id);

            $this->flushCache();

            return api_success_info('删除成功');
        } catch (\Exception $exception) {

            throw new ApiException('删除失败');
        }
    }

    /**
     * 清除缓存
     */
    protected function flushCache()
    {
        Cache::tags('links')->flush();
    }
}
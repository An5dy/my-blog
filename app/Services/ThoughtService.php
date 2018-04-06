<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Repositories\ThoughtRepository;
use Illuminate\Support\Facades\Cache;

class ThoughtService
{
    protected $thoughtRepository;

    protected $attributes = [];

    protected $columns = [
        'id', 'title', 'created_at', 'updated_at'
    ];

    /**
     * 注入ThoughtRepository
     *
     * ThoughtService constructor.
     * @param ThoughtRepository $thoughtRepository
     */
    public function __construct(ThoughtRepository $thoughtRepository)
    {
        $this->thoughtRepository = $thoughtRepository;
    }

    /**
     * 列表
     *
     * @return mixed
     */
    public function index()
    {
        $thoughts = $this->thoughtRepository
                         ->paginate(null, $this->columns);

        return $thoughts;
    }

    /**
     * 返回所有数据
     *
     * @return mixed
     */
    public function all()
    {
        // 新增缓存
        $thoughts = Cache::tags(['thoughts'])->rememberForever('thoughts', function () {
            return $this->thoughtRepository->all($this->columns);
        });

        return $thoughts;
    }

    /**
     * 保存或修改随想
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function createOrUpdate(Request $request, $id = 0)
    {
        $this->attributes = [
            'title' => $request->title,
            'markdown' => $request->markdown,
            'description' => transform_markdown($request->markdown),
        ];
        if (empty($id)) {
            $thought = $this->thoughtRepository
                            ->create($this->attributes);
        } else {
            $thought = $this->thoughtRepository
                            ->update($this->attributes, $id);
        }

        $this->flushCache();

        return $thought;
    }

    /**
     * 详情
     *
     * @param $id
     * @param string $filed
     * @return mixed
     */
    public function show($id, $filed = 'markdown')
    {
        $this->columns[] = $filed;
        try {
            $thought = $this->thoughtRepository
                            ->find($id, $this->columns);
        } catch (\Exception $exception) {

            throw new ApiException('当前文章不存在!');
        }

        return $thought;
    }

    /**
     * 删除随想
     *
     * @param $id
     * @throws ApiException
     */
    public function destroy($id)
    {
        try {
            $this->thoughtRepository
                 ->delete($id);

            $this->flushCache();
        } catch (\Exception $exception) {

            throw new ApiException('删除失败！');
        }
    }

    /**
     * 清除缓存
     */
    protected function flushCache()
    {
        Cache::tags('thoughts')->flush();
    }
}
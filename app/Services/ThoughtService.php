<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Eloquent\ThoughtRepositoryEloquent as ThoughtRepository;

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
                         ->orderBy('id', 'desc')
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

        $thought = $this->thoughtRepository->createOrUpdate($this->attributes, $id);

        flush_cache_by_tag('thoughts');

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

        $thought = $this->thoughtRepository->find($id, $this->columns);

        return $thought;
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $this->thoughtRepository->delete($id);

        flush_cache_by_tag('thoughts');

        return api_success_info('删除成功!');
    }
}
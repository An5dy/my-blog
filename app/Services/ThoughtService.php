<?php

namespace App\Services;

use App\Exceptions\ApiException;
use Illuminate\Http\Request;
use App\Repositories\ThoughtRepository;

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
        } catch (\Exception $exception) {

            throw new ApiException('删除失败！');
        }
    }
}
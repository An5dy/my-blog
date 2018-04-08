<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Repositories\Eloquent\TagRepositoryEloquent as TagRepository;

class TagService
{
    protected $tagRepository;

    /**
     * TagService constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
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
            $this->tagRepository
                 ->delete($id);

            return api_success_info('删除成功');
        } catch (\Exception $exception) {

            throw new ApiException('删除失败');
        }
    }
}
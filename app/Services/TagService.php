<?php

namespace App\Services;

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
     */
    public function destroy($id)
    {
        $this->tagRepository->delete($id);

        return api_success_info('删除成功');
    }
}
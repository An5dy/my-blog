<?php

namespace App\Http\Controllers\Admin;

use App\Services\TagService;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    protected $tagService;

    /**
     * 注入TagService
     *
     * TagController constructor.
     * @param TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    public function __invoke($id)
    {
        $response = $this->tagService->destroy($id);

        return $response;
    }
}

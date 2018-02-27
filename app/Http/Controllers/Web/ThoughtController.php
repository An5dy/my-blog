<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\ThoughtService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThoughtResource;
use App\Http\Resources\ThoughtCollection;

class ThoughtController extends Controller
{
    protected $thoughtService;

    /**
     * 依赖注入
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
        $thoughts = $this->thoughtService
                         ->all();

        return new ThoughtCollection($thoughts);
    }

    /**
     * 详情
     *
     * @param $id
     * @return ThoughtResource
     */
    public function show($id)
    {
        $thought = $this->thoughtService
                        ->show($id, 'description');

        return new ThoughtResource($thought);
    }
}

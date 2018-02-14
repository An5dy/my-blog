<?php

namespace App\Services;

use App\Http\Resources\AboutResource;
use App\Repositories\AboutRepository;
use Illuminate\Http\Request;

class AboutService
{
    protected $aboutRepository;

    protected $attributes = [];

    /**
     * AboutService constructor.
     * @param AboutRepository $aboutRepository
     */
    public function __construct(AboutRepository $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    /**
     * 关于详情
     *
     * @return AboutResource
     */
    public function index()
    {
        $about = $this->aboutRepository
                      ->first(['id', 'markdown']);

        return new AboutResource($about);
    }

    /**
     * 发布
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $this->attributes = [
            'markdown' => $request->markdown,
            'description' => transform_markdown($request->markdown),
        ];
        $id = $request->id;
        if (empty($id)) {
            $about = $this->aboutRepository
                          ->create($this->attributes);
        } else {
            $about = $this->aboutRepository
                          ->update($this->attributes, $id);
        }

        return new AboutResource($about);
    }

    /**
     * 关于
     *
     * @return AboutResource
     */
    public function show()
    {
        $about = $this->aboutRepository
                      ->first(['description', 'created_at']);

        return new AboutResource($about);
    }
}
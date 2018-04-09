<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Repositories\Eloquent\AboutRepositoryEloquent as AboutRepository;

class AboutService
{
    protected $aboutRepository;

    protected $attributes = [];

    protected $columns = [];

    /**
     * AboutService constructor.
     * @param AboutRepository $aboutRepository
     */
    public function __construct(AboutRepository $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    /**
     * 发布
     *
     * @param Request $request
     * @return mixed
     */
    public function createOrUpdate(Request $request)
    {
        $this->attributes = [
            'markdown' => $request->markdown,
            'description' => transform_markdown($request->markdown),
        ];
        $about = $this->aboutRepository->createOrUpdate($this->attributes, $request->id);

        return $about;
    }

    /**
     * 详情
     *
     * @return mixed
     * @throws ApiException
     */
    public function show()
    {
        $this->columns = is_admin_prefix() ? ['id', 'markdown'] : ['description', 'created_at'];

        $about = $this->aboutRepository->first($this->columns);

        if (empty($about)) {
            throw new ApiException('关于不存在！');
        }

        return $about;
    }
}
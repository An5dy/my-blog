<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    protected $uploadService;

    /**
     * UploadController constructor.
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * 图片上传
     *
     * @param Request $request
     * @return array
     */
    public function upload(Request $request)
    {
        $response= $this->uploadService->upload();

        return $response;
    }
}

<?php

namespace App\Services;

use Image;

class UploadService
{
    protected $prefix = '.jpg';

    protected $image;

    protected $imageName;

    protected $imgObj;

    /**
     * 上传图片
     *
     * @return array
     */
    public function upload()
    {
        // 获取图片
        $this->getImage();
        if ($this->image->isValid()) {
            // 设置保存图片名
            $this->setImageName();
            // 处理图片
            $this->handleImage();
            // 获取图片及压缩图片地址
            if (request('thumb')) {
                return api_success_info('10000', '图片上传成功', [
                    $this->getImagePath(),
                    $this->getImageThumbPath(),
                ]);
            }
            // 获取图片地址
            return api_success_info('上传成功', [$this->getImagePath()]);
        } else {
            return api_error_info('请上传正确的图片');
        }
    }

    /**
     * 获取图片
     */
    protected function getImage()
    {
        $this->image = request()->file('image');
    }

    /**
     * 设置图片名
     */
    protected function setImageName()
    {
        $this->imageName = 'img_' . date('YmdHis', time()) . random_int(100000, 999999) . $this->prefix;
    }

    /**
     * 处理图片
     */
    protected function handleImage()
    {
        $this->imgObj = Image::make($this->image);
        if (request('thumb')) {
            $this->resize();
        }
        // 保存图片
        $this->imgObj->save('uploads/' . $this->imageName);
    }

    /**
     * 压缩图片
     */
    protected function resize()
    {
        $this->imgObj = $this->imgObj->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        // 保存
        $this->imgObj->save('uploads/' . 'thumb_'  . $this->imageName);
    }

    /**
     * 获取图片地址
     *
     * @return string
     */
    protected function getImagePath()
    {
//        $path = asset('uploads/' . $this->imageName);
        $path = '/uploads/' . $this->imageName;

        return $path;
    }

    /**
     * 获取压缩图片地址
     *
     * @return string
     */
    protected function getImageThumbPath()
    {
        $path = asset('uploads/' . 'thumb_' . $this->imageName);

        return $path;
    }
}
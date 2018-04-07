<?php

if ( ! function_exists('api_success_info')) {
    /**
     * api正确返回格式
     *
     * @param $code
     * @param $message
     * @return array
     */
    function api_success_info($message = '', array $data = [], $code = '10000')
    {
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
    }
}

if ( ! function_exists('api_error_info')) {
    /**
     * 错误提示
     *
     * @param $code
     * @param $message
     * @return array
     */
    function api_error_info($message, $code = '20000')
    {
        return [
            'code' => $code,
            'message' => $message,
        ];
    }
}

if ( ! function_exists('api_success_response')) {
    /**
     * api返回正确提示
     *
     * @默认status为200请求成功
     * @param array $data
     * @param string $codeMessageKey
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    function api_success_response(array $data = [], string $codeMessageKey = '10000', int $status = 200)
    {
        $arr = [
            'code' => $codeMessageKey,
            'message' => config('global.codeMessage.' . $codeMessageKey),
        ];
        if ( ! empty($data)) {
            $arr['data'] = $data;
        }

        return response()->json($arr, $status);
    }
}

if ( ! function_exists('api_error_response')) {
    /**
     * api返回错误提示
     *
     * @默认status为400请求参数错误
     * @param string $codeMessageKey
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    function api_error_response($codeMessageKey = '20000', $status = 400)
    {
        $arr = [
            'code' => $codeMessageKey,
            'message' => config('global.codeMessage.' . $codeMessageKey),
        ];

        return response()->json($arr, $status);
    }
}

if ( ! function_exists('user')) {
    /**
     * 返回当前登录的用户信息
     *
     * @param null $guard
     * @return mixed
     */
    function user($guard = null)
    {
        return empty($guard) ? app('auth')->user() : app('auth')->guard($guard)->user();
    }
}

if ( ! function_exists('transform_markdown')) {
    /**
     * 转换markdown格式文本
     *
     * @param $markdown
     * @param bool $markupEscaped
     * @return string
     */
    function transform_markdown($markdown, $markupEscaped = true)
    {
        return Parsedown::instance()
                        ->setMarkupEscaped($markupEscaped)
                        ->text($markdown);
    }
}

if ( ! function_exists('flush_cache_by_key')) {
    /**
     * 通过键值删除缓存
     *
     * @param $key
     */
    function flush_cache_by_key($key)
    {
        cache()->forget($key);
    }
}

if ( ! function_exists('flush_cache_by_tag')) {
    /**
     * 通过标记清除缓存
     *
     * @param $tag
     */
    function flush_cache_by_tag($tag)
    {
        cache()->tags($tag)->flush();
    }
}
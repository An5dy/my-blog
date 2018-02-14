<?php

if ( ! function_exists('api_success_info')) {
    /**
     * api正确返回格式
     *
     * @param $code
     * @param $message
     * @return array
     */
    function api_success_info($message, array $data = [], $code = '10000')
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
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'path' => 'bail|required|url|max:255',
            'description' => 'bail|string|max:255',
        ];
    }

    /**
     * 自定义错误提示
     *
     * @return array
     */
    public function messages()
    {
        return [
            'path.required' => '链接不能为空！',
            'path.url' => '链接不正确！',
            'path.max' => '链接长度不能超过255个字符',
            'description.string' => '简介格式不正确',
            'description.max' => '简介长度不能超过255个字符',
        ];
    }
}

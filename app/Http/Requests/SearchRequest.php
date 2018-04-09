<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'orderBy' => 'bail|string',
            'title' => 'bail|string|max:255',
        ];
    }

    /**
     * 自定义错误信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'orderBy.string' => '排序字段格式不正确！',
            'title.string' => '搜索标题必须为字符串！',
            'title.max' => '搜索标题最多255个字符！',
        ];
    }
}

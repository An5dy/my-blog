<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => 'bail|required|string|unique:categories|max:255',
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
            'title.required' => '分类标题不能为空！',
            'title.string' => '分类标题必须为字符串！',
            'title.unique' => '分类标题已存在！',
            'title.max' => '分类标题长度不能大于255个字符',
        ];
    }
}

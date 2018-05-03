<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'bail|required|string|max:255',
            'markdown' => 'bail|required|string',
            'category' => 'bail|required|integer|exists:categories,id',
            'tags.*' => 'bail|string|max:60',
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
            'tags.*.string' => '标签格式不正确！',
            'tags.*.max' => '标签最多60个字符!'
        ];
    }
}

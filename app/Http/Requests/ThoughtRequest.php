<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThoughtRequest extends FormRequest
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
            'title' => 'bail|required|max:255',
            'markdown' => 'required',
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
            'title.required' => '标题不能为空！',
            'title.max' => '标题最多255个字符',
            'markdown.required' => '正文不能为空！',
        ];
    }
}

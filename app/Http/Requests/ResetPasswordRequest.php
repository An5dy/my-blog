<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * 重写认证错误
     *
     * @param Validator $validator
     * @throws ApiException
     */
    public function failedValidation(Validator $validator)
    {
        throw new ApiException($validator->errors()->first());
    }

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
            'oldPassword' => 'bail|required|string',
            'newPassword' => 'bail|required|string|min:6|max:255',
        ];
    }

    /**
     * 错误提示
     *
     * @return array
     */
    public function messages()
    {
        return [
            'oldPassword.required' => '旧密码不能为空',
            'oldPassword.string' => '旧密码必须为字符串',
            'newPassword.required' => '新密码不能为空',
            'newPassword.string' => '新密码必须为字符串',
            'newPassword.min' => '新密码不能少于6位',
            'newPassword.max' => '新密码不能多于255位',
        ];
    }
}

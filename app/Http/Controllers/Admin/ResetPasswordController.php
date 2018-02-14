<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /**
     * 重置密码
     *
     * @param ResetPasswordRequest $request
     * @return array
     */
    public function reset(ResetPasswordRequest $request)
    {
        $user = $request->user();
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return api_success_info('密码重置成功');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * 重写登录
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::guard('admin')->once($this->credentials($request))) {
            $admin = user('admin');
            $token = $admin->createToken('Admin Token')->accessToken;
            // 设置cookie（永不过期）
            $cookie = Cookie::forever('admin', json_encode([
                'name' => $admin->name,
                'access_token' => $token
            ]), null, null, false, false);

            return response()->json(api_success_info('登录成功'))
                             ->withCookie($cookie);
        } else {

            return api_error_info('登录失败，用户名或密码错误!', '20000');
        }
    }

    /**
     * 退出登录
     *
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        // 删除access_token
        user('jwt')->token()
                          ->revoke();
        // 清除cookie
        $cookie = Cookie::forget('admin');

        return response()->json(api_success_info('退出成功'))
                         ->withCookie($cookie);
    }

    /**
     * 重写用户登录名
     *
     * @return string
     */
    public function username()
    {
        return 'name';
    }
}

<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Support\Facades\Hash;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->oldPassword)) { throw new ApiException('原密码不能为空'); }
        // hash验证密码
        $user = $request->user();
        $boolean = Hash::check($request->oldPassword, $user->getAuthPassword());
        if (! $boolean) { throw new ApiException('原密码错误'); }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\ApiException;
use Illuminate\Contracts\Auth\Factory as Auth;

class ApiAuthenticate
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate(array $guards)
    {
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                // 兼容后台，只适用于passport
                if (user($guard)->token()->client_id == 2 && $guard == 'api') {
                    return $this->auth->shouldUse($guard);
                }
                if (user($guard)->token()->client_id == 1 && $guard == 'jwt') {
                    return $this->auth->shouldUse($guard);
                }
            }
        }

        throw new ApiException('未登录或登录已超时.', '30000');
    }
}

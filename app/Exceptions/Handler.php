<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // findOrFail 和 firstOrFail 异常处理
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(api_error_info('查询对象不存在', '20000'));
        }
        // QueryException 数据库查询异常
        if ($exception instanceof QueryException) {
            return response()->json(api_error_info('系统异常', '20000'));
        }
        // ValidationException 表单验证异常
        if ($exception instanceof ValidationException) {
            $message = collect($exception->errors())->flatten()->first();
            return response()->json(api_error_info($message, '20000'));
        }

        return parent::render($request, $exception);
    }
}

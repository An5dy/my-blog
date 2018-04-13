<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 前台路由
Route::any('{all}', function () {
    return view('index');
})->where(['all' => '^(?!admin).*$']);
// 后台路由
Route::any('/admin/{all?}', function () {
    return view('admin.index');
})->where('all', '.*?');

<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* 后台api接口 */
Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function () {
    Route::post('/login', 'LoginController@login');// 登录
});

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => 'api:jwt'], function () {
    Route::post('/logout', 'LoginController@logout');// 退出登录
    Route::post('/reset_password', 'ResetPasswordController@reset')->middleware('check.password');// 重置密码
    Route::post('/uploads', 'UploadController@upload');// 上传图片
    Route::get('/categories', 'CategoryController@index');// 分类列表
    Route::post('/categories/list', 'CategoryController@list');// 所有分类
    Route::post('/categories', 'CategoryController@store');// 添加分类
    Route::post('/categories/update/{id}', 'CategoryController@update')->where('id', '[0-9]+');// 编辑分类
    Route::post('/categories/{id}', 'CategoryController@destroy')->where('id', '[0-9]+');// 删除分类
    Route::post('/tags/{id}', 'TagController@destroy')->where('id', '[0-9]+');// 删除标签
    Route::get('/articles', 'ArticleController@index');// 文章列表
    Route::post('/articles', 'ArticleController@store');// 新增文章
    Route::post('/articles/{id}', 'ArticleController@destroy')->where('id', '[0-9]+');// 删除文章
    Route::get('/articles/edit/{id}', 'ArticleController@edit')->where('id', '[0-9]+');// 获取文章详情
    Route::post('/articles/update/{id}', 'ArticleController@update')->where('id', '[0-9]+');// 编辑文章
    Route::get('/links', 'LinkController@index');// 链接列表
    Route::post('/links', 'LinkController@store');// 新增链接
    Route::post('/links/{id}', 'LinkController@destroy')->where('id', '[0-9]+');// 删除链接
    Route::post('/links/update/{id}', 'LinkController@update')->where('id', '[0-9]+');// 编辑链接
    Route::get('/about', 'AboutController@index');// 关于
    Route::post('/about', 'AboutController@store');// 保存关于信息
    Route::get('/thoughts', 'ThoughtController@index');// 随想列表
    Route::post('/thoughts', 'ThoughtController@store');// 新增随想
    Route::get('/thoughts/edit/{id}', 'ThoughtController@show');// 获取随想详情
    Route::post('/thoughts/update/{id}', 'ThoughtController@update')->where('id', '[0-9]+');// 编辑随想
    Route::post('/thoughts/{id}', 'ThoughtController@destroy')->where('id', '[0-9]+');// 删除随想
});
/* 前台api接口 */
Route::group(['prefix' => '/', 'namespace' => 'Web'], function () {
    Route::get('/articles', 'ArticleController@list');// 文章列表
    Route::get('/articles/{id}', 'ArticleController@show')->where('id', '[0-9]+');// 文章详情
    Route::get('/archives', 'ArchiveController@index');// 文章归档
    Route::get('/sidebars', 'SidebarController@index');// 侧边栏
    Route::get('/about', 'AboutController@index');// 关于
    Route::get('/thoughts', 'ThoughtController@index');// 随想列表
    Route::get('/thoughts/{id}', 'ThoughtController@show');// 随想详情
});
/* github webhook接口 */
Route::post('/deploy', 'Hook\DeploymentController@deploy');// webhook

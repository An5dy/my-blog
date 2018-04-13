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
    Route::post('/reset_password', 'ResetPasswordController')->middleware('check.password');// 重置密码
    Route::post('/uploads', 'UploadController');// 上传图片
    Route::post('/categories/list', 'CategoryController@list');// 所有分类
    Route::post('/tags/{id}', 'TagController')->where('id', '[0-9]+');// 删除标签
    Route::get('/about', 'AboutController@index');// 关于
    Route::post('/about', 'AboutController@store');// 保存关于信息
    Route::apiResources([
        '/categories' => 'CategoryController',// 文章路由
        '/articles' => 'ArticleController',// 文章路由
        '/links' => 'LinkController',// 链接路由
        '/thoughts' => 'ThoughtController',// 随想路由
    ]);
});
/* 前台api接口 */
Route::group(['prefix' => '/', 'namespace' => 'Web'], function () {
    Route::get('/articles', 'ArticleController@index');// 文章列表
    Route::get('/articles/{id}', 'ArticleController@show')->where('id', '[0-9]+');// 文章详情
    Route::get('/thoughts', 'ThoughtController@index');// 随想列表
    Route::get('/thoughts/{id}', 'ThoughtController@show')->where('id', '[0-9]+');// 随想详情
    Route::get('/archives', 'ArchiveController');// 文章归档
    Route::get('/sidebars', 'SidebarController');// 侧边栏
    Route::get('/about', 'AboutController');// 关于
});
/* github webhook接口 */
Route::post('/deploy', 'Hook\DeploymentController@deploy');// webhook

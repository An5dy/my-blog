<?php

return [

    /*
    |--------------------------------------------------------------------------
    | oauth配置文件设置
    |--------------------------------------------------------------------------
    */

    'passport' => [
        'personal_access_client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'personal_access_client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
        'grant_client_id' => env('PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
        'grant_client_secret' => env('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | 后台账号初始化信息
    |--------------------------------------------------------------------------
    */

    'admin' => [
        'name' => env('ADMIN_NAME'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    /*
    |--------------------------------------------------------------------------
    | 文章列表字数显示设置
    |--------------------------------------------------------------------------
    */

    'article' => [
        'limit' => 256,
        'hot_limit' => 5,
        'new_limit' => 5,
    ],
];
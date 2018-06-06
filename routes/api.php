<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'serializer:array'
],function ($api) {

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ],function($api) {
      // 登陆
      $api->post('authorizations', 'AuthorizationsController@store')
          ->name('api.authorizations.store');

      // 刷新token
      $api->put('authorizations/current', 'AuthorizationsController@update')
          ->name('api.authorizations.update');

      // 删除token
      $api->delete('authorizations/current', 'AuthorizationsController@destroy')
          ->name('api.authorizations.destroy');
    });

    $api->group([
       'middleware' => 'api.throttle',
       'limit' => config('api.rate_limits.access.limit'),
       'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
       // 游客可以访问的接口

       // 需要 token 验证的接口
       $api->group(['middleware' => 'api.auth'], function($api) {
           // 当前登录用户信息
           $api->get('user', 'UserController@me')
               ->name('api.user.show');

           // 用户授权信息
           $api->post('user/authorizeInformation', 'UserController@authorizeInformations')
               ->name('api.user.authorizeInformations');
       });
   });

});

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
       // 需要 token 验证的接口
       $api->group(['middleware' => 'api.auth'], function($api) {
           // 当前登录用户信息
           $api->get('user', 'UserController@me')
               ->name('api.user.show');

           // 用户授权信息
           $api->post('user/authorizeInformation', 'UserController@authorizeInformations')
               ->name('api.user.authorizeInformations');

           // 当前登录用户所有分组
           $api->get('categories', 'CategoryController@showList')
               ->name('api.category.showList');

           // 添加分组
           $api->post('categories/new_category', 'CategoryController@create')
               ->name('api.category.create');

           // 编辑分组
           $api->patch('categories/edit_category', 'CategoryController@edit')
               ->name('api.category.edit');

           // 删除分组
           $api->delete('categories/delete_category/{category}', 'CategoryController@delete')
               ->name('api.category.delete');

           // 新建卡片
           $api->post('cards/new_card', 'CardController@create')
               ->name('api.card.create');

           // 编辑卡片
           $api->patch('cards/edit_card', 'CardController@edit')
               ->name('api.card.edit');

           // 删除卡片
           $api->delete('cards/delete_card/{card}', 'CardController@delete')
               ->name('api.card.delete');

           // 当前登录用户所有卡牌
           $api->get('cards', 'CardController@showList')
               ->name('api.card.showList');

           // 指定分组的卡牌
           $api->get('cards/{category}', 'CardController@showByCategory')
               ->name('api.card.showByCategory');
       });
   });

});

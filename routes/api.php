<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
],function ($api) {
    // 登陆
    $api->post('authorizations', 'AuthorizationsController@store')
    ->name('api.authorizations.store');
});

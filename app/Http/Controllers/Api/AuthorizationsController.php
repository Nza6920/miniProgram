<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\MiniProgramAuthorizationRequest;
use Auth;
use App\Models\User;

class AuthorizationsController extends Controller
{
     public function store(MiniProgramAuthorizationRequest $request)
     {
        $code = $request->code;
        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);


        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 不正确');
        }

        // 找到 openid 对应的用户
        $hasUser = User::where('openid', $data['openid'])->first();


        if(!$hasUser) {
          // 未找到用户
          $user = new User;
          $user->name = null;
          $user->avatar = null;
          $user->openid = $data['openid'];
          $user->weixin_session_key = $data['session_key'];
          $user->save();
        }else {
          $hasUser->weixin_session_key = $data['session_key'];
          $hasUser->save();
          $user = $hasUser;
        }

        // 为用户创建 Jwt
        $token = Auth::guard('api')->fromUser($user);
        return  $this->respondWithToken($token)->setStatusCode(201);
     }

      protected function respondWithToken($token)
      {
          return $this->response->array([
              'access_token' => $token,
              'token_type' => 'Bearer',
              'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
          ]);
      }

      // 刷新 token
      public function update()
      {
          $token = Auth::guard('api')->refresh();
          return $this->respondWithToken($token);
      }

      // 删除 token
      public function destroy()
      {
          Auth::guard('api')->logout();
          return $this->response->noContent();
      }
}

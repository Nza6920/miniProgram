<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\AuthorizeInformation;

class UserController extends Controller
{
    public function me()
    {
        // $this->user() 等价于 \Auth::guard('api')->user() 返回当前登录用户
        return $this->response->item($this->user(),new UserTransformer());
    }

    // 用户授权信息
    public function authorizeInformations(AuthorizeInformation $request)
    {
       $miniProgram = \EasyWeChat::miniProgram();
       $user = $this->user();
       $iv = $request->iv;
       $encryptData = $request->encryptedData;
       $session = 'M7JwVYqIl+/afRMfH9cupw==';
      //  $session = $user->weixin_session_key;
       $decryptedData = $miniProgram->encryptor->decryptData($session, $iv, $encryptData);
       return $decryptedData;
       $user->name = $decryptedData->nickName;
       $user->avatar = $decryptedData->avatarUrl;

       $user->save();

       return $this->response->item($user,new UserTransformer());
    }
}

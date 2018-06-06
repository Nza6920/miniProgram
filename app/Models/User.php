<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = false;

    protected $fillable = [
      'name','avatar','openid','weixin_session_key'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

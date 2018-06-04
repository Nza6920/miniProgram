<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}

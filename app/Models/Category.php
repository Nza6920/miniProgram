<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'name', 'introduction'
    ];

    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

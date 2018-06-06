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
        return $this->hasMany(Card::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

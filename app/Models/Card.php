<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'front','behind'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Card');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function events() {
        return $this->belongsToMany('App\Event');
    }
}
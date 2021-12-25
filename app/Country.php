<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public function events() {
        return $this->belongsToMany('App\Event');
    }

    public function packages() {
        return $this->belongsToMany('App\Package');
    }
}
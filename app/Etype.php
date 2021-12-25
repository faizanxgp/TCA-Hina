<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etype extends Model
{

    public function events() {
        return $this->belongsTo('App\Event');
    }
}
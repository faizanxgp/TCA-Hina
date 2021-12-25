<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{

    protected $table = 'user_data';

    public function user() {
        return $this->belongsTo('App\User');
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    protected $table = 'team_user';

    protected $fillable = [
        'team_id', 'user_id'
    ];

    public function team() {
        return $this->belongsTo('App\Team');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialEvent extends Model
{

    protected $fillable = [
        'event_id', 'social'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }
}
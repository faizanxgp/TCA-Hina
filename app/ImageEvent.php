<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageEvent extends Model
{

    protected $fillable = [
        'event_id', 'image'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }
}
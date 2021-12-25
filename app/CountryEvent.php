<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryEvent extends Model
{
    protected $table = 'country_event';

    protected $fillable = [
        'event_id', 'country_id'
    ];

//    public function country() {
//        return $this->belongsTo('App\Country');
//    }
//
//    public function event() {
//        return $this->belongsTo('App\Event');
//    }
}
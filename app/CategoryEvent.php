<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryEvent extends Model
{


    protected $table = 'category_event';

    protected $fillable = [
        'event_id', 'category_id'
    ];

//    public function category() {
//        return $this->belongsTo('App\Category');
//    }
//
//    public function event() {
//        return $this->belongsTo('App\Event');
//    }
}
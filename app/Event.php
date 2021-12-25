<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    //protected $dates = ['from_date', 'upto_date'];

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function countries() {
        return $this->belongsToMany('App\Country');
    }

    public function teams() {
        return $this->belongsToMany('App\Team');
    }


    public function pin() {
        return $this->hasMany('App\Pin');
    }

    public function mypin() {
        $pin = $this->pin()->where('user_id', \Auth::user()->id);

        if ($pin == null or empty($pin)) {
            return null;
        } else {
            return $pin;
        }
    }



    public function etype() {
        return $this->belongsTo('App\Etype');
    }

    public function shared() {
        $teams = $this->teams()->where('event_team.user_id', \Auth::user()->id)->get();

        if ($teams == null or empty($teams)) {
            return 'None';
        } else {
            $names = [];
            foreach($teams as $team) {
                array_push($names, $team->title);

            }
            return join(", ", $names);
        }
    }

    public function mycountries() {
        $countries = $this->countries()->get();

        if ($countries == null or empty($countries)) {
            return '';
        } else {
            $names = [];
            foreach($countries as $country) {
                array_push($names, $country->country);

            }
            return join(", ", $names);
        }
    }
}
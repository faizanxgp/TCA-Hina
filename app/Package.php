<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    public function countries() {
        return $this->belongsToMany('App\Country');
    }

    public function countriesclean() {

        $result = $this->countries()->select('country_id')->orderBy('country_id')->get();
        if ($result == null) {
        } else {
            return $result;
        }
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }
}
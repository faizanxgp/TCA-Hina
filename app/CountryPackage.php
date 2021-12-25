<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryPackage extends Model
{
    protected $table = 'country_package';

    protected $fillable = [
        'package_id', 'country_id'
    ];

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function package() {
        return $this->belongsTo('App\Package');
    }
}
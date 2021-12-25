<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPackage extends Model
{
    protected $table = 'category_package';

    protected $fillable = [
        'package_id', 'category_id'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function package() {
        return $this->belongsTo('App\Package');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtypePackage extends Model
{
    protected $table = 'etype_package';

    protected $fillable = [
        'package_id', 'etype_id'
    ];

    public function etype() {
        return $this->belongsTo('App\Etype');
    }

    public function package() {
        return $this->belongsTo('App\Package');
    }
}
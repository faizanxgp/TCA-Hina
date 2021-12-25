<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subscriptions() {
        return $this->hasMany('App\UserSubscription');
    }

    public function membership() {

        $now = date("Y-m-d");
        $result = $this->subscriptions()->where('upto_date', '>=', $now)->orderBy('upto_date', 'DESC')->first();
        if ($result == null) {

        } else {
            return $result;
        }

    }

    public function memberInfo() {
        $now = date("Y-m-d");
        $data = "";
        $upackage = $this->subscriptions()->where('upto_date', '>=', $now)->orderBy('upto_date', 'DESC')->first();
        //dump($upackage);
        if ($upackage == null) {
            //$data['package_id'] = '0';
            //$data['title'] = 'Free';
            //$data['connects'] = 5;
            $data = "No Package";
            //['from_date'] = '';
            //$data['upto_date'] = '';
        } else {
            //$pid = $upackage['package_id'];
//            $package = Package::findOrFail($pid);
//            $data['package_id'] = $upackage['package_id'];
//            $data['title'] = $package->package;
            //$data['connects'] = $package->connects;
            $data = $upackage['package']->package . " from " . $upackage['from_date'] . " to " . $upackage['upto_date'];
            //$data['from_date'] = $upackage['from_date'];
            //$data['upto_date'] = $upackage['upto_date'];
        }
        //dump($data);
        //()->where('product_id', $p_id)->where('user_id', $user_id)->get();
        return $data;
    }

    public function subscription() {

        $now = date("Y-m-d");

        $data = "";

        $upackage = $this->subscriptions()->where('upto_date', '>=', $now)->orderBy('upto_date', 'DESC')->first();

        dump($upackage);

        if ($upackage == null) {
            //$data['package_id'] = '0';
            //$data['title'] = 'Free';
            //$data['connects'] = 5;
            $data = "No Package";
            //['from_date'] = '';
            //$data['upto_date'] = '';
        } else {

            //$pid = $upackage['package_id'];
            //$package = Package::findOrFail($pid);
            //$data['package_id'] = $upackage['package_id'];
            //$data['title'] = $package->package;
            //$data['connects'] = $package->connects;
            $data = $upackage['package']->package . " from " . $upackage['from_date'] . " to " . $upackage['upto_date'];
            //$data['from_date'] = $upackage['from_date'];
            //$data['upto_date'] = $upackage['upto_date'];

        }
        //dump($data);
        //()->where('product_id', $p_id)->where('user_id', $user_id)->get();
        return $data;
    }
}

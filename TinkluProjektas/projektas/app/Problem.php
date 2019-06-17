<?php
/**
 * Created by PhpStorm.
 * User: Tadas
 * Date: 12/5/2018
 * Time: 5:13 PM
 */

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Problem extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'devicename', 'description', 'status', 'ip', 'registrationtime', 'operatorid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function technic()
    {
        return $this->hasOne('App\User', 'id', 'technicid');
    }

    public function operator()
    {
        return $this->hasOne('App\User', 'id', 'operatorid');
    }
}
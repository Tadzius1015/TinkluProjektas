<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ReportWorker extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workername', 'workersurname', 'avgresponsetime', 'avgfixingtime', 'intervalbegin', 'intervalend', 'repaireddevicescount', 'takingdevicescount',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
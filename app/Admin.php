<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = ['name', 'email', 'password', 'active', 'role'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
}

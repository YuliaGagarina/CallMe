<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'department',
        'position',
        'name',
        'login',
        'password',
        'phone',
        'e-mail',
        'rights',
        'age',
        'address',
        'user_id'
    ];
}

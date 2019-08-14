<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone'
    ];
}

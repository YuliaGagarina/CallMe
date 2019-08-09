<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'product group',
        'provider',
        'position',
        'name',
        'phone',
        'e-mail',
        'created by'
    ];
}

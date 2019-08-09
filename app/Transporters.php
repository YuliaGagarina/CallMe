<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transporters extends Model
{
    protected $fillable = [
        'kind of transport',
        'transporter',
        'position',
        'name',
        'phone',
        'e-mail',
        'created by'
        ];
}

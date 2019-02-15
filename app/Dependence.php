<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    protected $fillable =[
        'name','acronym','country',
    ];
}

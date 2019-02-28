<?php

namespace App;
use App\Institute;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name', 'reception', 'objective', 'contractValidity', 'scope','institute_id',
    ];

    public function institutions(){
        return $this ->belongsToMany(Institute::class);
    }

    public function users(){
        return $this ->belongsToMany('App\User')
        ->withTimeStamps();
    }
}

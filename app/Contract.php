<?php

namespace App;
use App\Institute;
use App\User;
use App\File;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name', 'reception', 'objective', 'contractValidity', 'scope','institute_id',
    ];
    public function files(){
        return $this ->belongsToMany(File::class)
        ->withTimestamps();
    }
    public function institutions(){
        return $this ->belongsToMany(Institute::class)
        ->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class)
        ->withTimeStamps();
    }
    public function getUser(){
        return $this ->belongsToMany(User::class,'contract_user')->withPivot('user_id','contract_id')
        ->withTimestamps();
    }
}

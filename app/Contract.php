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
    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    public function scopeReception($query,$reception){
        if($reception){
            return $query->where('reception','LIKE',"%$reception%");
        }
    }
    public function scopeId($query,$id){
        if($id){
            return $query->where('id','LIKE',"%$id%");
        }
    }
    public function scopeScope($query,$scope){
        if($scope){
            return $query->where('scope','LIKE',"%$scope%");
        }
    }
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

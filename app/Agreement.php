<?php

namespace App;
use App\Institute;
use App\Dependence;
use App\User;
use App\FileAgreement;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $fillable = [
        'name', 'reception', 'objective', 'agreementValidity', 'scope','dependence_id','hide',
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
        return $this ->belongsToMany(FileAgreement::class)
        ->withTimestamps();
    }
    public function institutions(){
        return $this ->belongsToMany(Institute::class)
        ->withTimestamps();
    }
    public function dependences(){
        return $this ->belongsToMany(Dependence::class)
        ->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class)
        ->withTimeStamps();
    }
    public function getUser(){
        return $this ->belongsToMany(User::class,'agreement_user')->withPivot('user_id','agreement_id')
        ->withTimestamps();
    }
    public function getFiles(){
        return $this ->belongsToMany(FileAgreement::class,'agreement_file_agreement')->withPivot('file_agreement_id','agreement_id')
        ->withTimestamps();
    }
    public function hasUser($email)
    {
        if ($this->users()->where('email', $email)->first()) {
            return true;
        }
        return false;
    }
}

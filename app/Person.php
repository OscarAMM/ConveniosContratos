<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name','type','country', 'email',
    ];
    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    public function scopeAcronym($query,$type){
        if($type){
            return $query->where('type','LIKE',"%$type%");
        }
    }
    public function scopeId($query,$id){
        if($id){
            return $query->where('id','LIKE',"%$id%");
        }
    }
    public function scopeCountry($query,$country){
        if($country){
            return $query->where('country','LIKE',"%$country%");
        }
    }
    public function scopeEmail($query, $email){
        if($email){
            return $query->where('email','LIKE',"%$email%");
        }
    }
}

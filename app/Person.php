<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name','personType','country', 'email',
    ];
    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    public function scopePersonType($query,$personType){
        if($personType){
            return $query->where('personType','LIKE',"%$personType%");
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
    }public function scopeAcronym($query, $acronym){
        if($acronym){
            return $query->where('acronym','LIKE',"%$acronym%");
        }
    }
}

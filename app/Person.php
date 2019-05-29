<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Agreement;

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
    public function agreements(){
        return $this->belongsToMany(Agreement::class)
        ->withTimestamps();
    }
    public function hasDocument($id)
    {
        if ($this->agreements()->where('agreement_id', $id)->first()) {
            return true;
        }
        return false;
    }
    public function getAgreements(){
        return $this->belongsToMany(Agreement::class,'agreement_person')->orderBy('id', 'ASC')->paginate();
    }
}

<?php

namespace App;
use App\Institute;
use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    protected $fillable =[
        'name','acronym','country','institute_id',
    ];

    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    public function scopeAcronym($query,$acronym){
        if($acronym){
            return $query->where('acronym','LIKE',"%$acronym%");
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
    public function institutions(){
        
        return $this 
            ->belongsToMany(Institute::class)
            ->withTimestamps();
    }
    public function getInstitutes(){
        return $this ->belongsToMany(Institute::class,'dependence_institute')->withPivot('institute_id','dependence_id'); ;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{   
    //Rellena los campos para la tabla
    protected $fillable = [
        'name','acronym','country',
    ];
    //Alcance del buscador
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
    //Relacion
    public function dependencies(){
        return $this ->hasMany(Dependence::class);
    }
}

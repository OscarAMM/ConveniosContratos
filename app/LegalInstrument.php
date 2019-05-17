<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalInstrument extends Model
{
    protected $fillable = [
        'name',
    ];
    public function scopeId($query,$id){
        if($id){
            return $query->where('id','LIKE',"%$id%");
        }
    }
    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
}

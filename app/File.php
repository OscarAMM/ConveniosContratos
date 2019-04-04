<?php

namespace App;
use App\Contract;
use App\Comment;


use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name','created_at'
    ];

    public function contracts(){
        return $this
        ->hasMany(Contract::class)
        ->withTimestamps();
    }
    public function comments(){
        return $this
        ->hasMany(Comment::class)
        ->withTimestamps();
    }
    public function getComments(){
        return $this->belongsToMany(Comment::class,'comment_file');
    }
}

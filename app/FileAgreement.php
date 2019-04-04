<?php

namespace App;
use App\Agreement;
use App\Comment;

use Illuminate\Database\Eloquent\Model;

class FileAgreement extends Model
{
    protected $fillable = [
        'name',
    ];

    public function agreements(){
        return $this
        ->hasMany(Agreement::class)
        ->withTimestamps();
    }
    public function comments(){
        return $this
        ->hasMany(Comment::class)
        ->withTimestamps();
    }
    public function getComments(){
        return $this->belongsToMany(Comment::class,'comment_file_agreement');
    }
}

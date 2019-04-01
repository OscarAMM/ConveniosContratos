<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Agreement;
use App\Contract;
class Comment extends Model
{
    protected $fillable = [
        'topic', 'comment','user'
    ];
    public function agreements(){
        return $this->belongsToMany(Agreement::class)
        ->withTimeStamps();
    }
    public function contracts(){
        return $this->belongsToMany(Contract::class)
        ->withTimeStamps();
    }

}

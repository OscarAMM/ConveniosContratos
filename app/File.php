<?php

namespace App;
use App\Contract;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
    ];

    public function contracts(){
        return $this
        ->hasMany(Contract::class)
        ->withTimestamps();
    }
}

<?php

namespace App;
use App\Institute;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name', 'reception', 'objective', 'contractValidity', 'scope',
    ];

    public function institutions(){
        return $this ->belongsToMany(Institute::class);
    }
}

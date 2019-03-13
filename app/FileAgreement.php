<?php

namespace App;
use App\Agreement;

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
}

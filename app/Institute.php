<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'instituciones';
    protected $primaryKey='claveinstituciones';
    protected $fillable = [
        'nombre', 'siglas', 'pais',
    ];

}

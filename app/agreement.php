<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agreement extends Model
{
    protected $table=convenio;
    protected $primaryKey='claveconvenio';
    public $timestamps=true;
    protected $fillable = [
        'nombre',
        'recepcion',
        'objetivo',
        'vigencia',
        'tipo',
        'ambito',
    ];
}

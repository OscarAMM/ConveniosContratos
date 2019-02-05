<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
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

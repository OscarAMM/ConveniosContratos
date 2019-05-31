<?php

namespace App;

use App\FileAgreement;
use App\Person;
use App\FinalRegister;
use Illuminate\Database\Eloquent\Model;

class FinalRegister extends Model
{
    protected $fillable = [
        'id', 'name', 'objective', 'legalInstrument', 'registerNumber', 'scope', 'hide', 'start_date', 'end_date', 'status',
    ];
    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'LIKE', "%$name%");
        }
    }
    public function scopesignature($query, $signature)
    {
        if ($signature) {
            return $query->where('signature', 'LIKE', "%$signature%");
        }
    }
    public function scopeLegalInstrument($query, $legalInstrument)
    {
        if ($legalInstrument) {
            return $query->where('legalInstrument', 'LIKE', "%$legalInstrument%");
        }
    }
    public function scopeId($query, $id)
    {
        if ($id) {
            return $query->where('id', 'LIKE', "%$id%");
        }
    }
    public function scopeInstrumentType($query, $instrumentType)
    {
        if ($instrumentType) {
            return $query->where('instrumentType', 'LIKE', "%$instrumentType%");
        }
    }
    public function scopeObjective($query, $objective)
    {
        if ($objective) {
            return $query->where('objective', 'LIKE', "%$objective%");
        }
    }
    public function scopePeople_id($query, $people_id)
    {
        if ($people_id) {
            return $query->where('people_id', 'LIKE', "%$people_id%");
        }
    }
    public function scopeSession($query, $session){
        if($session){
            return $query->where('session', 'LIKE', "%$session%");
        }
    }
    public function scopeEnd_date($query, $end_date)
    {
        if ($end_date) {
            return $query->where('end_date', 'LIKE', "%$end_date%");
        }
    }
    public function people()
    {
        return $this->belongsToMany(Person::class)
            ->withTimestamps();
    }
    public function getPeople()
    {
        return $this->belongsToMany(Person::class, 'final_register_person')->withPivot('person_id', 'final_register_id')
            ->withTimestamps();
    }
    public function files()
    {
        return $this->belongsToMany(FileAgreement::class)
            ->withTimestamps();
    }
    public function getFiles()
    {
        return $this->belongsToMany(FileAgreement::class, 'file_agreement_final_register')->withPivot('file_agreement_id', 'final_register_id')
            ->withTimestamps();
    }
    public function getLastFile()
    {
        //User::orderBy('created_at', 'desc')->first();
        return $this->belongsToMany(FileAgreement::orderby('created_at', 'desc')->latest()->first(), 'file_agreement_final_register');
    }
    
    
}

<?php

namespace App;

use App\Comment;
use App\Dependence;
use App\FileAgreement;
use App\Institute;
use App\Person;
use App\User;
use Illuminate\Database\Eloquent\Model;

class FinalRegister extends Model
{
    protected $fillable = [
        'id', 'name', 'reception', 'objective', 'legalInstrument', 'registerNumber', 'scope', 'hide', 'start_date', 'end_date', 'status', 'liable_user', 'people_id',
    ];
    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'LIKE', "%$name%");
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
    public function scopePeople_id($query, $people_id)
    {
        if ($people_id) {
            return $query->where('people_id', 'LIKE', "%$people_id%");
        }
    }
    public function scopeObjective($query, $objective)
    {
        if ($objective) {
            return $query->where('objective', 'LIKE', "%$objective%");
        }
    }
    public function files()
    {
        return $this->belongsToMany(FileAgreement::class)
            ->withTimestamps();
    }
    public function institutions()
    {
        return $this->belongsToMany(Institute::class)
            ->withTimestamps();
    }
    public function dependences()
    {
        return $this->belongsToMany(Dependence::class)
            ->withTimestamps();
    }
    public function people()
    {
        return $this->belongsToMany(Person::class)
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimeStamps();
    }
    public function comments()
    {
        return $this->belongsToMany(Comment::class)
            ->withTimestamps();
    }
    public function getComments()
    {
        return $this->belongsToMany(Comment::class, 'agreement_comment');
    }
    public function getUser()
    {
        return $this->belongsToMany(User::class, 'agreement_user')->withPivot('user_id', 'agreement_id')
            ->withTimestamps();
    }
    public function getFiles()
    {
        return $this->belongsToMany(FileAgreement::class, 'agreement_file_agreement')->withPivot('file_agreement_id', 'agreement_id')
            ->withTimestamps();
    }
    public function getLastFile()
    {
        //User::orderBy('created_at', 'desc')->first();
        return $this->belongsToMany(FileAgreement::orderby('created_at', 'desc')->latest()->first(), 'agreement_file_agreement');
    }
    public function hasUser($email)
    {
        if ($this->users()->where('email', $email)->first()) {
            return true;
        }
        return false;
    }
}

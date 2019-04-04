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
    public function filesAgreements(){
        return $this ->belongsToMany(FileAgreement::class)
        ->withTimestamps();
    }
    public function filesContracts(){
        return $this ->belongsToMany(File::class)
        ->withTimestamps();
    }
    public function getFilesAgreements(){
        return $this ->belongsToMany(FileAgreement::class,'comment_file_agreement');
    }
    public function getFilesContracts(){
        return $this ->belongsToMany(File::class,'comment_file');
    }
    

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //Query Scope
    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    public function scopeEmail($query,$email){
        if($email){
            return $query->where('email','LIKE',"%$email%");
        }
    }
    public function scopeId($query,$id){
        if($id){
            return $query->where('id','LIKE',"%$id%");
        }
    }

    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
    public function contracts(){
        return $this->belongsToMany(Contract::class)
        ->withTimeStamps();
    }
    public function hasContract($name)
    {
        if ($this->contracts()->where('name', $name)->first()) {
            return true;
        }
        return false;
    }
    public function getContracts(){
        return $this->belongsToMany(Contract::class,'contract_user');
    }
    public function agreements(){
        return $this->belongsToMany(Agreement::class)
        ->withTimeStamps();
    }
    public function hasAgreement($name)
    {
        if ($this->agreements()->where('name', $name)->first()) {
            return true;
        }
        return false;
    }
    public function hasDocument($id)
    {
        if ($this->agreements()->where('agreement_id', $id)->first()) {
            return true;
        }
        return false;
    }
    public function getAgreements(){
        return $this->belongsToMany(Agreement::class,'agreement_user')->orderBy('id', 'DESC');
    }
}

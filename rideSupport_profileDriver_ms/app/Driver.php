<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//Añadimos la clase JWTSubject 
use Tymon\JWTAuth\Contracts\JWTSubject;

class Driver extends Authenticatable implements JWTSubject
{
    protected $table ='drivers';
    
    protected $fillable = [
        'email',
        'password',
        'name',
        'lastname',
        'age',
        'address',
        'phone',
        'vehicle',
        'remember_token',
];
protected $hidden = [
    
];

/*
    Añadiremos estos dos métodos
*/
public function getJWTIdentifier()
{
    return $this->getKey();
}
public function getJWTCustomClaims()
{
    return [];
}
   
    //
}

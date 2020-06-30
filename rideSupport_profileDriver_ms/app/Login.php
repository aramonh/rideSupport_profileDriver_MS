<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table ='drivers';
    
    protected $fillable = ['email','password'];

}

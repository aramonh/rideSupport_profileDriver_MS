<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table ='drivers';
    
    protected $fillable = ['name','email','password'];

    //
}

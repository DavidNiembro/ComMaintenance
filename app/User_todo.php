<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_todo extends Model 
{

    protected $table = 'user_todo';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
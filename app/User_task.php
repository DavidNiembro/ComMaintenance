<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_task extends Model 
{

    protected $table = 'user_task';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['fkTask']; 

    public function task()
    {
        return $this->belongsTo('App\Task', 'fkTask', 'id');
    }
   

}
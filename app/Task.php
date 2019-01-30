<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model 
{

    protected $table = 'tasks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'description', 'state', 'fkTodo']; 

    public function todo()
    {
        return $this->belongsTo('App\Todo','fkTodo','id');
    }
    public function user_task()
    {
        return $this->hasMany('App\User_task','fkTask','id');
    }
}
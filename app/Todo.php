<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model 
{

    protected $table = 'todos';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'title', 'description']; 

    public function tasks()
    {
        return $this->hasMany('App\Task', "fkTodo","id");
    }

}
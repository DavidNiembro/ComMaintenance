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
    protected $fillable = ['title', 'description']; 

    public function taches()
    {
        return $this->hasMany('App\Checklist_item', "fkTodo","id");
    }

}
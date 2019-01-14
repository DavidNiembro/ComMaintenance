<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User_task;
use App\Task;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //$todos = Todo::all();
        $request->user()->authorizeRoles(['admin','user']);
        $role = $request->user()->roles()->first()->name;
        switch($role){
            case 'admin':{
                $todos = Todo::all();
                return view('home',compact("todos"));
                break;
            }
            case 'user':{
                $todos = [];
                $id = Auth::id();
                $test = User_task::all()->where("fkUser", $id);
            
                foreach($test as $t){
                    $task = $t->task()->first();
                    $todo = $task->todo()->first();
                    if (!in_array($todo, $todos)){
                        array_push($todos, $todo);
                    }
                }
                return view('home',compact("todos"));
                break;
            }
        }
    }
}

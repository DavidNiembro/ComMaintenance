<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User_task;
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
    public function index()
    {
        //$todos = Todo::all();
        $todos = [];
        $id = Auth::id();
        $test = User_task::all()->where("fkUser", $id);
        foreach($test as $t){
           array_push($todos, $t->todos);
        }
        //dd($test);
        return view('home',compact("todos"));
    }
}

<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User_task;
use App\Task;
use App\User;


use Illuminate\Support\Facades\Auth;
class TodosController extends Controller 
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
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $request->user()->authorizeRoles(['admin','user']);
    $role = $request->user()->roles()->first()->name;
    switch($role){
      case 'admin':{
          $todos = Todo::all();
          return view('admin/todos',compact("todos"));
          break;
      }
      case 'user':{
          $todos = [];
          $idUser = Auth::id();
          $UserTask = User_task::all()->where("fkUser", $idUser);
          foreach($UserTask as $t){
              $task = Task::find($t->fkTask);
              $taskTodo = Todo::find($task->fkTodo);
       
              if ($taskTodo->id == $task->fkTodo && !in_array($taskTodo,$todos)){
                array_push($todos, $taskTodo);
              }
          }
          return view('todos',compact("todos"));
          break;
      }
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $task = Todo::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'title' => $request->title,
        'description' => $request->description
      ]
  );
  return redirect('/todos');
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id, Request $request)
  {
    $request->user()->authorizeRoles(['admin','user']);
    $role = $request->user()->roles()->first()->name;
    switch($role){
      case 'admin':{
        $todo = Todo::find($id);
        $users = User::all();
        $UserTasks = User_task::all();
        $tasks = [];
       
        foreach($UserTasks as $t){
         //dd($t);
          $task = $t->task()->first();
          $taskTodo = $task->todo()->first();
          if ($taskTodo->id == $id){
            array_push($tasks, $t);
          }
        }
        return view('admin/todo',compact("todo","users","tasks"));
        break;
      }
      case 'user':{
        $todo = Todo::find($id);
        $tasks = [];
        $idUser = Auth::id();
        $test = User_task::all()->where("fkUser", $idUser);
        foreach($test as $t){
            $task = $t->task()->first();
            $taskTodo = $task->todo()->first();
            if ($taskTodo->id == $task->fkTodo && $taskTodo->id == $id){
              array_push($tasks, $t);
            }
        }
        return view('todo', compact("tasks","todo"));
        break;
      }
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function assign(Request $request)
  {
    $fkTodo = $request->fkTodo;
    $fkUser = $request->fkUser;
    $todo = Todo::find($fkTodo);
    $tasks = $todo->tasks()->get();
    
    foreach($tasks as $task){
      $UserTask = new User_task;
      $UserTask->fkTask = $task->id;
      $UserTask->fkUser = $fkUser;
      $UserTask->beginTask = $request->begin;
      $UserTask->endTask = $request->end;
      $UserTask->state = 0;
      $UserTask->save();
    }
    return redirect('/todos');
  }  
}

?>
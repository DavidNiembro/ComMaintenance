<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User_task;
use App\Task;
use App\User;
use Carbon\Carbon;

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
          $idUser = Auth::id();
          $todos = Todo::with(['tasks','tasks.user_task'])->whereHas('tasks.user_task', function($query) use($idUser) {
            $query->where("fkUser",$idUser);
          })->get();    
          foreach($todos as $key=>$todo){
            $todoEndTask = Carbon::minValue();
            $countTask = 0;
            foreach($todo->tasks as $task){
              foreach($task->user_task as $userTask){
                if(!$userTask->state){
                  $countTask++;
                }
                if(Carbon::createFromTimeString($userTask->endTask)>Carbon::createFromTimeString($todoEndTask)){
                  $todoEndTask = $userTask->endTask;
                  $todos[$key]->endDate = $todoEndTask;
                }
              }
            }
            $todos[$key]->countTask = $countTask;
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
      ['id' => $request->id],
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
        $users = User::with('roles')->whereHas('roles', function($query) {
          $query->where("name","!=","admin");
        })->get();

        $todo = Todo::with(['tasks','tasks.user_task'])->where('id',$id)->first();

        return view('admin/todo',compact("todo","users"));
        break;
      }
      case 'user':{
        $todo = Todo::find($id);
        $idUser = Auth::id();

        $todo = Todo::with(['tasks','tasks.user_task'])->where('id',$id)->whereHas('tasks.user_task', function($query) use($idUser) {
          $query->where("fkUser",$idUser);
        })->first();  

        return view('todo', compact("todo"));

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
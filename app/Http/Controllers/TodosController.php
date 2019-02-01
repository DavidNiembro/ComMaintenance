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
    //is Authorised ?
    $request->user()->authorizeRoles(['admin','user']);
    
    //Get Roles
    $role = $request->user()->roles()->first()->name;
    $idUser = Auth::id();

    switch($role){
      case 'admin':{

          //Collect all todos
          $todos = Todo::all();

          //Collect the last finish date
          foreach($todos as $key => $todo){

            $lastDate = null;

            foreach($todo->tasks()->get() as $task){
              foreach($task->user_task()->get() as $user_task){
                  if($lastDate < $user_task->finishTask){
                    $lastDate = $user_task->finishTask;
                  }
              }
            }
            $todos[$key]->lastDate = $lastDate;
          }
          $listUserTasks = User_Task::with(['user','task' => function($query) { 
            $query->withTrashed();
            },'task.todo'])->orderBy('endTask', 'ASC')->get();
          
          $listUserDelayedTasks = User_Task::with(['user','task' => function($query) { 
              $query->withTrashed();
            },'task.todo'])->where('finishTask','=',null)->where('endTask','<', new Carbon)->orderBy('endTask', 'ASC')->get();
  
          return view('admin/todos',compact("todos",'listUserTasks', 'listUserDelayedTasks'));
          break;
      }
      case 'user':{

        //collect todos for the user
          $todos = Todo::with(['tasks','tasks.user_task'])->whereHas('tasks.user_task', function($query) use($idUser) {
            $query->where("fkUser",$idUser);
          })->get();

          //Collect remaining task
          foreach($todos as $key=>$todo){
            $todoEndTask = Carbon::minValue();
            $countTask = 0;
            foreach($todo->tasks as $task){
              foreach($task->user_task as $userTask){
                if(!$userTask->state && $userTask->fkUser==$idUser){
                  $countTask++;
                }
                if(Carbon::createFromTimeString($userTask->endTask)>Carbon::createFromTimeString($todoEndTask)){
                  $todoEndTask = $userTask->endTask;
                  $todos[$key]->endDate = $todoEndTask;
                }
              }
            }
            if($countTask==0){
              $todos[$key]->countLibelle = 'Terminé';
            }else if($countTask == count($todo->tasks)){
              $todos[$key]->countLibelle = "A faire";
            }else{
              $todos[$key]->countLibelle = "En cours";
            };
            $todos[$key]->countTask = $countTask;
          }

          $listUserTasks = User_Task::with(['user','task' => function($query) { 
            $query->withTrashed();
            },'task.todo'])->where('fkUser',Auth::id())->orderBy('endTask', 'ASC')->get();

          return view('todos',compact("todos", "listUserTasks"));
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
    //is Authorised ?
    $request->user()->authorizeRoles(['admin','user']);
    
    //Get Roles
    $role = $request->user()->roles()->first()->name;
    $idUser = Auth::id();
    
    switch($role){
      case 'admin':{

        //Collect all users
        $users = User::with('roles')->whereHas('roles', function($query) {
          $query->where("name","!=","admin");
        })->get();

        //Collect todo
        $todo = Todo::with(['tasks','tasks.user_task','tasks.user_task.user'])->where('id',$id)->first();
        $histories = [];

        //Create an history 
        foreach($todo->tasks as $keyt=>$tache){
          $finished = 0; 
          foreach ($tache->user_task as $key=>$user_task){

              if(array_key_exists($user_task->beginTask,$histories)){

                array_push($histories[$user_task->beginTask], $tache);
                if($user_task->finishTask != null || $user_task->finishTask != ''){
                  $finished += 1; 
                }
              }else{

                $histories[$user_task->beginTask]= [];
                array_push($histories[$user_task->beginTask], $tache);
                if($user_task->finishTask != null || $user_task->finishTask != ''){
                  $finished += 1; 
                }
              }
          }
        }
        return view('admin/todo',compact("todo","users","histories"));
        break;
      }
      case 'user':{ 
        
        //Collect Todo
        $todo = Todo::with(['tasks','tasks.User_task'])->where('id',$id)->first(); 

        $todos = Todo::with(['tasks' => function($query) { 
          $query->withTrashed();
          },'tasks.User_task'])->where('id',$id)->first(); 

        //create an history
        $histories = [];
        foreach($todos->tasks as $tache){
          foreach ($tache->user_task as $user_task){
            if($user_task->state && $user_task->fkUser == $idUser){
              if(array_key_exists($user_task->beginTask,$histories)){
                array_push($histories[$user_task->beginTask], $tache);
              }else{
                $histories[$user_task->beginTask]= [];
                array_push($histories[$user_task->beginTask], $tache);
              }
            }
          }
        }
        return view('todo', compact("todo","histories","idUser"));

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
      $UserTask->endTask = $request->begin;
      $UserTask->state = 0;
      $UserTask->save();
    }
    return redirect('/todos');
  }  
}

?>
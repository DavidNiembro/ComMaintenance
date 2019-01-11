<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Task;

class TasksController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
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
      $task = Task::updateOrCreate(
        ['id' => $request->id],
        [
          'title' => $request->title,
          'description' => $request->description,
          'state'=>$request->state == null ? 0 : $request->state,
          'fkTodo'=>$request->fkTodo
        ]
    );
    return redirect()->route('todo', ['id' => $request->fkTodo]);


  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
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
    dd($id);

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
  
}

?>
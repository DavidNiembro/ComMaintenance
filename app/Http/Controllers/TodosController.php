<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
class TodosController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $todos = Todo::all();
      
      return view('todos', compact("todos"));
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
  public function show($id)
  {
    $todo = Todo::find($id);
    $todo->taches;
    return view('todo', compact("todo"));
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
  
}

?>
@extends('layouts.app')

@section('content')
<div class="container">
<h1>Administration</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titre</th>
      <th scope="col">Nombre de tâches</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
    <a href="/todo/{{ $todo->id }}">
        <tr>
        <th scope="row">{{ $todo->id }}</th>
        <td>{{ $todo->title }}</td>
        <td>{{ count($todo->tasks) }}</td>
        <td><a href="/todo/{{ $todo->id }}" class="btn btn-primary">Voir</a></td>
        </tr>
    </a>
    @endforeach
  </tbody>
</table>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
           <!-- Button trigger modal -->
            <button type="button" style="margin-top:20px" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Creer une nouvelle
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form action="{{ url('todos') }}" method="POST">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Nouvelle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Entrez un titre</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description de la tâche">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Créer la todo</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
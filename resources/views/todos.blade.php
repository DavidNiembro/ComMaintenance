@extends('layouts.app')

@section('content')

<div class="container">
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
</div>
@endsection

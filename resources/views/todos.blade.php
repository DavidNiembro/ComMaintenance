@extends('layouts.app')

@section('content')

<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col" class="text-center">Nombre de tâches</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
    <a href="/todo/{{ $todo->id }}">
        <tr>
        <td>{{ $todo->title }}</td>
        <td class="text-center">{{ count($todo->tasks) }}</td>
        <td><a href="/todo/{{ $todo->id }}" class="btn btn-primary">Voir</a></td>
        </tr>
    </a>
    @endforeach
  </tbody>
</table> 
</div>
@endsection

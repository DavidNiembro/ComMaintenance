@extends('layouts.app')

@section('content')
<div class="container">
<h1>Tableau de bord</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col" class="text-center">Nombre de tâches</th>
      <th scope="col" class="text-center">Echéance</th>
      <th scope="col" class="text-center">Etat</th>
      <th scope="col" class="text-center">Nombre de tâches restantes</th>

      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
    <a href="/todo/{{ $todo->id }}">
        <tr>
        <td>{{ $todo->title }}</td>
        <td class="text-center">{{ count($todo->tasks) }}</td>
        <td class="text-center">{{ \Carbon\Carbon::createFromTimeString($todo->endDate)->format('d M Y') }}</td>
        <td class="text-center">{{ $todo->countTask > 0 ? 'En cours' : 'Terminé'}}</td>
        <td class="text-center">{{ $todo->countTask}}</td>
        <td><a href="/todo/{{ $todo->id }}" class="btn btn-primary">Voir</a></td>
        </tr>
    </a>
    @endforeach
  </tbody>
</table> 
</div>
@endsection

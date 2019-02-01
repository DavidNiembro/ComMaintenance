@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Tableau de bord</h1>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mes Todos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Toutes mes tâches</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
              <td class="text-center">{{ $todo->countLibelle}}</td>
              <td class="text-center">{{ $todo->countTask}}</td>
              <td><a href="/todo/{{ $todo->id }}" class="btn btn-primary">Voir</a></td>
              </tr>
          </a>
          @endforeach
        </tbody>
      </table> 
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Tâche</th>
            <th scope="col" class="text-center">Utilisateur</th>
            <th scope="col" class="text-center">Todo</th>
              <th scope="col" class="text-center">A finir pour</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($listUserTasks as $user_task)
              <tr>
                  <td class="text-center">{{ $user_task->task->title }}</td>
                  <td class="text-center">{{ $user_task->user->name }}</td>
                  <td class="text-center">{{ $user_task->task->todo->title }}</td>
                  <td class="text-center">{{ \Carbon\Carbon::createFromTimeString($user_task->endTask)->format('d M Y') }}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

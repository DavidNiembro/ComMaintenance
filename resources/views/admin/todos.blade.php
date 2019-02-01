@extends('layouts.app')

@section('content')
<div class="container">
<h1>Administration</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Toutes les todos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Toutes les tâches</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tâches en retard <span class="badge badge-pill badge-danger">{{count($listUserDelayedTasks)}}</span></a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Titre</th>
                    <th scope="col" class="text-center">Nombre de tâches</th>
                    <th scope="col" class="text-center">Dernière tâche terminée le</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                    <a href="/todo/{{ $todo->id }}">
                        <tr>
                            <td>{{ $todo->title }}</td>
                            <td class="text-center">{{ count($todo->tasks) }}</td>
                            <td class="text-center">{{ $todo->lastDate ? \Carbon\Carbon::createFromTimeString($todo->lastDate)->format('d M Y'):'Pas encore de date' }}</td>
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
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                    @foreach ($listUserDelayedTasks as $user_task)

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
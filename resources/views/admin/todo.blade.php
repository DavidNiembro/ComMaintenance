@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                <h1>{{$todo->title}}</h1>
            </div>
            <div>
                <p>{{$todo->description}}</p>
            </div>
            <div class="row"> 
                @foreach($todo->tasks as $task)
                    <form action="{{ url('tasks/deleteTask') }}" method="POST">
                      {{ csrf_field() }}
                        <div class="col-sm-12" style="margin-top:20px">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $task->title }}</h5>
                                    <p class="card-text">{{ $task->description }}</p>
                                    <input type="text" hidden name="idTask" id="idTask" value="{{$task->id}}">
                                    <input type="text" hidden name="fkTodo" id="fkTodo" value="{{$todo->id}}">
                                 
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        Supprimer
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer cette tâche ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                <button class="btn btn-danger" type="sumbit">Supprimer</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach   
            </div>
            
            
           
     
            <!-- Modal -->
            <div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form action="{{ url('tasks/create') }}" method="POST">
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
                            <input type="text" hidden name="fkTodo" id="fkTodo" value="{{$todo->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Créer la tâche</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form action="{{ url('assign') }}" method="POST">
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
                            <label for="fkUser">Utilisateur</label>
                            <select name="fkUser" class="form-control" >
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} {{$user->firstname}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="begin">Date</label>
                                <input type="date" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="begin" name="begin" placeholder="02-02-2018">
                            </div>
                            <input type="text" hidden name="fkTodo" id="fkTodo" value="{{$todo->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Assigner</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 
    <div class="row justify-content-center">
        <div class="col-md-6">
            <button type="button" style="margin-top:20px" class="btn btn-primary" data-toggle="modal" data-target="#createTask">
                Creer une nouvelle tâche
            </button>
        </div>
        <div class="col-md-6">
            <button type="button" style="margin-top:20px" class="btn btn-primary" data-toggle="modal" data-target="#assign">
                Assigner la todo
            </button>
        </div>
    </div>
   
    <div class="col-md-12">
    <div>
        <h1>Assignations</h1>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" >Date</th>
                        <th scope="col">Utilisateur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $key => $history)
                        <tr>
                            <td>{{ \Carbon\Carbon::createFromTimeString($key)->format('d M Y') }} </td>
                            <td>{{$history[0]->user_task->first()->user->name}} </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table> 
        </div>   
    </div>
    <div class="row">                
    </div>
    </div>

</div>
@endsection

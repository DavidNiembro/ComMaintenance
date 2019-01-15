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
                    <div class="col-sm-12" style="margin-top:20px">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p class="card-text">{{ $task->description }}</p>
                                </div>
                            </div>
                        </div>
                @endforeach   
            </div>
            
            
           
     
            <!-- Modal -->
            <div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form action="{{ url('tasks') }}" method="POST">
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
                            <select name="fkUser" class="form-control" >
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} {{$user->firstname}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="description">Du</label>
                                <input type="date" class="form-control" id="begin" name="begin" placeholder="02-02-2018">
                            </div>
                            <div class="form-group">
                                <label for="description">Au</label>
                                <input type="date" class="form-control" id="end" name="end" placeholder="02-02-2018">
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
    </div>
    <div class="row">                
    </div>
    </div>

</div>
@endsection

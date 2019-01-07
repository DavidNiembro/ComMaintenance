@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo</div>
                    <div class="container">
                        <div class="row">
                            @foreach ($todo->taches as $tache)
                            <div class="col-sm-6" style="margin-top:20px">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $tache->title }}</h5>
                                            <p class="card-text">{{ $tache->description }}</p>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="card-text">{{ $tache->state ? "Terminée":"A faire"}}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a href="/checklist_items/{{ $tache->id}}" class="btn btn-primary">C'est fait</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>          
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form action="{{ url('checklist_items') }}" method="POST">
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
    </div> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="button" style="margin-top:20px" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Creer une nouvelle
            </button>
        </div>
    </div>
</div>
@endsection

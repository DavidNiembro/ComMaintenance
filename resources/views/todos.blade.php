@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                @foreach ($todos as $todo)
                    <div class="col-sm-6" style="margin-top:20px">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $todo->title }}</h5>
                            <p class="card-text">{{ $todo->description }}</p>
                            <a href="/todo/{{ $todo->id }}" class="btn btn-primary">Voir</a>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
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

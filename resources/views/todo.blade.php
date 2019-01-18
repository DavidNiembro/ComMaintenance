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
                @foreach ($todo->tasks as $tache)
                    @if(!$tache->user_task->first()->state)
                        <div class="col-sm-4" style="margin-top:20px">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">{{ $tache->title }}</h5>
                                <p class="card-text">{{ $tache->description }}</p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="card-text">{{ $tache->user_task->first()->state ? "Terminée":"A faire"}}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <form method="POST" action="{{ url('tasks') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{$tache->user_task->first()->id}}" name="id">
                                                    <input type="hidden" value="{{$tache->user_task->first()->fkTodo}}" name="fkTodo">
                                                    <button type="submit" class="btn btn-primary">C'est fait</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>          
        </div>
        <div class="col-md-12">
            <div>
                <h2>Historique</h2>
            </div>
            <div class="row">
                @foreach ($todo->tasks as $tache)
                    @if($tache->user_task->first()->state)
                        <div class="col-sm-4" style="margin-top:20px">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $tache->title }}</h5>
                                    <p class="card-text">{{ $tache->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>          
        </div>
    </div> 
</div>
@endsection

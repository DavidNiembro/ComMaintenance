@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo</div>
                    <div class="container">
                    <div>{{$todo->title}}</div>
                        <div class="row">
                            @foreach ($tasks as $tache)
                            @if(!$tache->state)
                            <div class="col-sm-6" style="margin-top:20px">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $tache->task->title }}</h5>
                                            <p class="card-text">{{ $tache->task->description }}</p>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="card-text">{{ $tache->task->state ? "Terminée":"A faire"}}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <form method="POST" action="{{ url('tasks') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{{$tache->task->id}}" name="id">
                                                        <input type="hidden" value="{{$tache->task->title}}" name="title">
                                                        <input type="hidden" value="{{$tache->task->description}}" name="description">
                                                        <input type="hidden" value="1" name="state">
                                                        <input type="hidden" value="{{$tache->task->fkTodo}}" name="fkTodo">
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
                </div>
            </div> 

            <div class="card">
                <div class="card-header">Todo</div>
                    <div class="container">
                    <div>{{$todo->title}}</div>
                        <div class="row">
                            @foreach ($tasks as $tache)
                            @if($tache->state)
                            <div class="col-sm-6" style="margin-top:20px">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $tache->task->title }}</h5>
                                            <p class="card-text">{{ $tache->task->description }}</p>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="card-text">{{ $tache->task->state ? "Terminée":"A faire"}}</p>
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
                </div>
            </div>          
        </div>
    </div> 
</div>
@endsection

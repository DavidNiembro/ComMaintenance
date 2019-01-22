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
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Titre</th>
                    <th scope="col" class="text-center">Description</th>
                    <th scope="col" class="text-center">Date de fin</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todo->tasks as $tache)
                        @foreach ($tache->user_task as $user_task)
                            @if(!$user_task->state)
                                <a href="/todo/{{ $todo->id }}">
                                    <tr>
                                    <td>{{ $tache->title }}</td>
                                    <td class="text-center">{{ $tache->description }}</td>
                                    <td class="text-center">{{ $user_task->endTask }}</td>
                                    <td> 
                                        <form method="POST" action="{{ url('tasks') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$user_task->id}}" name="id">
                                            <input type="hidden" value="{{$tache->fkTodo}}" name="fkTodo">
                                            <button type="submit" class="btn btn-primary">C'est fait</button>
                                        </form>
                                    </td>
                                    </tr>
                                </a>    
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table> 
            </div>          
        </div>
        <div class="col-md-12">
            <div>
                <h2>Historique</h2>
            </div>
            <div class="row">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Titre</th>
                    <th scope="col" class="text-center">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todo->tasks as $tache)
                        @foreach ($tache->user_task as $user_task)
                            @if($user_task->state)
                                <a href="/todo/{{ $todo->id }}">
                                    <tr>
                                    <td>{{ $tache->title }}</td>
                                    <td class="text-center">{{ $tache->description }}</td>
                                    </tr>
                                </a>    
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table> 
            </div>          
        </div>
    </div> 
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>{{$todo->title}}</h1>
    </div>
    <div>
        <p>{{$todo->description}}</p>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tâches en cours</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Historique</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="col-md-12">
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
                                    @if(!$user_task->state && $user_task->fkUser == $idUser)
                                        <a href="/todo/{{ $todo->id }}">
                                            <tr>
                                            <td>{{ $tache->title }}</td>
                                            <td class="text-center">{{ $tache->description }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::createFromTimeString($user_task->endTask)->format('d M Y') }}</td>
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
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> <div class="col-md-12">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Titre</th>
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $key => $history)
                        <tr>
                        <th scope="col">{{ \Carbon\Carbon::createFromTimeString($key)->format('d M Y') }}</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                            @foreach ($history as $tasks)
                                        <tr>
                                            <td>{{ $tasks->title }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::createFromTimeString($tasks->user_task->first()->finishTask)->format('d M Y')  }}</td>
                                            <td>{{ $tasks->description }}</td>
                                        </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table> 
            </div>          
        </div>
    </div>
</div> 
@endsection

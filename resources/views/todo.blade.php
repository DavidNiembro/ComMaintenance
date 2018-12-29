@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo</div>
                @foreach ($todo->taches as $tache)
                   <p>{{ $tache->title }} {{ $tache->description }} {{ $tache->state }}</p>
                @endforeach
            </div>
            <form action="{{ url('checklist_items') }}" method="POST">
                {{ csrf_field() }}
                <label for="title">Entrez votre nom : </label>
                <input type="text" name="title" id="title">
                <label for="description">Entrez votre description : </label>
                <input type="text" name="description" id="description">
                <input type="text" hidden name="fkTodo" id="fkTodo" value="{{$todo->id}}">
                <input type="submit" value="Envoyer !">
            </form>
        </div>
    </div>
</div>
@endsection

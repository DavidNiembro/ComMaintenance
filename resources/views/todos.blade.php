@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todos</div>
                @foreach ($todos as $todo)
                    <a href="/todo/{{ $todo->id }}"><p>This is user {{ $todo->title }} </p></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

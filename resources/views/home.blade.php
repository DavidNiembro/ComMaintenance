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
        </div>
    </div>
</div>
@endsection

@extends('layouts.main')

@section('title', $title)

@section('author')
    <h1 class="text-white">{{ $title }}</h1>
    <h2 class="text-white">{{ $author['name'] }}</h2>
    <p class="text-white">{{ $author['bio'] }}</p>

    <div class="wrapper">
        <div class="row justify-content-between">
            @foreach($books as $book)
            <div class="card col-md-4 m-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$book['name']}}</h5>
                    <p class="card-text">Create: {{ $book['create'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('title', $title)

@section('books')
    <h1>{{ $title }}</h1>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Authors
        </button>
        <ul class="dropdown-menu">

            @foreach($authors as $author )
                <li><a class="dropdown-item" href="{{ route("books.author", ['id' => $author['id']]) }}">{{ $author['name'] }}</a></li>
            @endforeach
        </ul>
    </div>

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

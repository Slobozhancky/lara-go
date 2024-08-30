@extends('layouts.main')

@section('title', $title)

@section('post')
    <h1>{{$title}}</h1>

    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-2">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post['title'] }}; ID: {{ $post['id'] }}</h5>
                            <p>{{ $post['content'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

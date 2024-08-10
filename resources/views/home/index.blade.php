@extends('layouts.main')

@section('title', $title)

@section('home')
    <h1>Home page</h1>

    <div class="container">
        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4 mb-2">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 @class(['text-success' => $loop->even, 'text-danger' => $loop->odd]) class="card-title">{{ $user['name'] }}; ID: {{ $user['id'] }}</h5>
                            <p>Phone: <a href="tel:{{ $user['phone'] }}"> {{ $user['phone'] }}</a></p>
                            <p>Email: <a href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection



@extends('layouts.main')

@section('title', $title)

@section('world')
    <h1>{{$title}}</h1>

    <div class="container">
        <div class="row">
            <table class="table table-dark table-striped">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Population</th>
                </tr>

                @foreach($countries as $country)
                    <tr>
                        <td>{{ $country['Code'] ?? '' }}</td>
                        <td>{{ $country['Name'] ?? '' }}</td>
                        <td>{{ $country['Region'] ?? '' }}</td>
                        <td>{{ $country['Population'] ?? '' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

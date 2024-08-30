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
                        <th>CountryCode</th>
                        <th>District</th>
                        <th>Population</th>
                    </tr>

                    @foreach($cities as $city)
                        <tr>
                            <td>{{ $city['ID'] ?? '' }}</td>
                            <td>{{ $city['Name'] ?? '' }}</td>
                            <td>{{ $city['CountryCode'] ?? '' }}</td>
                            <td>{{ $city['District'] ?? '' }}</td>
                            <td>{{ $city['Population'] ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

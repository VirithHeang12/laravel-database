@extends('layouts.layout')

@section('title')
    {{ __('cars')}}
@endsection

@section('content')
    <table class="table table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th class="py-3" scope="col">ID</th>
                <th class="py-3" scope="col">Model</th>
                <th class="py-3" scope="col">Year</th>
                <th class="py-3" scope="col">Color</th>
                <th class="py-3" scope="col">Engine Type</th>
                <th class="py-3" scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <th scope="row">{{ $car->id }}</th>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->color }}</td>
                    <td>{{ $car->engine_type }}</td>
                    <td>{{ $car->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('cars.index') }}" class="btn btn-dark">Back</a>
@endsection

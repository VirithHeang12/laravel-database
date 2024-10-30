@extends('layouts.layout')

@section('content')
    <div class="container mb-5">
        <h2 class="text-center" style="color: grey;">Car Infomation</h2>
        <div class="col-6 mx-auto mt-4">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $car->id }}</td>
                    </tr>
                    <tr>
                        <th>Model</th>
                        <td>{{ $car->model }}</td>
                    </tr>
                    <tr>
                        <th>Year</th>
                        <td>{{ $car->year }}</td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td>{{ $car->color }}</td>
                    </tr>
                    <tr>
                        <th>Engine Type</th>
                        <td>{{ $car->engine_type }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $car->price }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="{{ route('cars.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Show Car
@endsection

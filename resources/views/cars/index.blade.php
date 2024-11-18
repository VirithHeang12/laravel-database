@extends('layouts.layout')

@section('title')
    {{ __('cars')}}
@endsection

@section('content')
    @if (session('success'))
        <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div id="success-message" class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1 class="text-center fw-bold">{{ __('cars') }}</h1>
    <a href="{{ route('cars.create') }}" class="btn btn-dark">Create Car</a>
    <a href="{{ route('cars.createImport') }}" class="btn btn-dark">Import Car</a>
    <a href="{{ route('cars.popular') }}" class="btn btn-dark">Popular Cars</a>
    <a href="{{ route('cars.deleted') }}" class="btn btn-dark">Show Deleted Cars</a>
    <form action="{{ route('cars.index') }}" method="GET">
        <label for="year">year</label>
        <input type="number" name="year" id="year" value="{{ request('year') }}">
        <label for="price">price</label>
        <input type="number" name="price" id="price" value="{{ request('price') }}">
        <label for="model">Model</label>
        <input type="text" name="model" id="model" value="{{ request('model') }}">
        <button type="submit" class="btn btn-primary mt-2">Filter</button>
    </form>
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
                    <td class="d-flex gap-2">
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary btn-sm">Show</a>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="post"
                            onsubmit="return confirm('Are you sure want to delete this cars?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $cars->links() }}
@endsection

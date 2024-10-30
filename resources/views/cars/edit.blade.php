@extends('layouts.layout')

@section('title')
    Create Car
@endsection

@section('content')
    <form action="{{ route('cars.update', $car->id) }}" method="post" class="p-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="model" class="form-label">Car Model</label>
            <input type="text" name="model" id="model" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="text" name="year" id="year" class="form-control">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" name="color" id="color" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="engine_type" class="form-label">Engine Type</label>
            <input type="text" name="engine_type" id="engine_type" class="form-control">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control">
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-dark">Update</button>
        </div>
    </form>
@endsection

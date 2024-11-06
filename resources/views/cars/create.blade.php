@extends('layouts.layout')

@section('title')
    Create Category
@endsection

@section('content')
    <form action="{{ route('cars.store') }}" method="post" class="p-4">
        @csrf
        <div class="mb-3">
            <label for="model" class="form-label">Car Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ old('model') }}">
            @error('model')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="text" name="year" id="year" class="form-control" value="{{ old('year') }}">
            @error('year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" name="color" id="color" class="form-control" value="{{ old('color') }}">
            @error('color')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="engine_type" class="form-label">Engine Type</label>
            <input type="text" name="engine_type" id="engine_type" class="form-control" value="{{ old('engine_type') }}">
            @error('engine_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-dark">Create</button>
        </div>
    </form>
@endsection

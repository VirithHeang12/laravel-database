@extends('layouts.layout')

@section('title')
    Edit Doctor
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center" style="color:grey;">Edit Product</h2>

        <form action="{{ route('doctors.update', $doctor->id)}}" method="post" class="p-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $doctor->full_name }}">
            </div>
            <div class="mb-3">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" name="specialty" id="specialty" class="form-control" value="{{ $doctor->specialty }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number" class="form-control" value="{{ $doctor->phone_number }}">
            </div>
            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

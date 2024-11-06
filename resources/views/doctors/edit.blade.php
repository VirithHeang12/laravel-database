@extends('layouts.layout')

@section('title')
    Edit Doctor
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center" style="color:grey;">Edit Product</h2>

        <form action="{{ route('doctors.update', $doctor->id) }}" method="post" class="p-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', $doctor->full_name) }}">
                @error('full_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="specialty" class="form-label">Specialty</label>
                <select name="specialty" id="specialty" class="form-select">
                    <option value="" disabled>Select specialty here</option>
                    <option value="Cardiology" {{ old('specialty', $doctor->specialty) == 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
                    <option value="Neurology" {{ old('specialty', $doctor->specialty) == 'Neurology' ? 'selected' : '' }}>Neurology</option>
                    <option value="Orthopedics" {{ old('specialty', $doctor->specialty) == 'Orthopedics' ? 'selected' : '' }}>Orthopedics</option>
                    <option value="General" {{ old('specialty', $doctor->specialty) == 'General' ? 'selected' : '' }}>General</option>
                    <option value="Pediatrician" {{ old('specialty', $doctor->specialty) == 'Pediatrician' ? 'selected' : '' }}>Pediatrician</option>
                </select>
                @error('specialty')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $doctor->phone_number) }}">
                @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

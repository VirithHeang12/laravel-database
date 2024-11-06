@extends('layouts.layout')

@section('title')
    Create Doctor
@endsection

@section('content')
    <form action="{{ route('doctors.store') }}" method="post" class="p-4">
        @csrf
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}"
                placeholder="Enter full name here" required>
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="specialty" class="form-label">Specialty</label>
            <select name="specialty" id="specialty" class="form-select">
                <option value="" disabled>Select specialty here</option>
                <option value="Cardiology" {{ old('specialty') == 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
                <option value="Neurology" {{ old('specialty') == 'Neurology' ? 'selected' : '' }}>Neurology</option>
                <option value="Orthopedics" {{ old('specialty') == 'Orthopedics' ? 'selected' : '' }}>Orthopedics</option>
                <option value="General" {{ old('specialty') == 'General' ? 'selected' : '' }}>General</option>
                <option value="Pediatrician" {{ old('specialty') == 'Pediatrician' ? 'selected' : '' }}>Pediatrician
                </option>
            </select>

            @error('specialty')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="tel" name="phone_number" id="phone_number" class="form-control"
                value="{{ old('phone_number') }}" placeholder="Enter phone number here" required>
            @error('phone_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-dark">Create</button>
        </div>
    </form>
@endsection

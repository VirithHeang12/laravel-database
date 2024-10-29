@extends('layouts.layout')

@section('title')
Create Category
@endsection

@section('content')
<form action="{{ route('doctors.store') }}" method="post" class="p-4">
    @csrf
    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" name="full_name" id="full_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="specialty" class="form-label">Specialty</label>
        <input type="text" name="specialty" id="specialty" class="form-control">
    </div>
    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="tel" name="phone_number" id="phone_number" class="form-control" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-dark">Create</button>
    </div>
</form>
@endsection




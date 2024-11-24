@extends('layouts.layout')

@section('content')
    <div class="row py-4">
        <div class="col-6 mx-auto">
            <h1 class="text-center mb-5">Edit Customer</h1>
            <form action="{{ route('customers.update', ['customer' => $customer->id]) }}" method="post">
                @csrf
                @method('PUT')
                <label class="form-label" for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $customer->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <label class="form-label" for="gender">Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="" disabled selected>Select gender here</option>
                    <option value="Female" {{ old('gender', $customer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Male" {{ old('gender', $customer->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                </select>
                @error('gender')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <label class="form-label" for="phone">Phone Number</label>
                <input class="form-control" name="phone" id="phone" value="{{ $customer->phone }}" readonly>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="d-flex justify-content-between">
                    <a class="btn btn-secondary px-4 mt-4" href="{{ route('customers.index') }}">Back</a>
                    <button class="btn btn-primary px-4 mt-4" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('title')
Edit Customer
@endsection




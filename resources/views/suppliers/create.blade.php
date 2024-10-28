@extends('suppliers.layouts.layout');

@section('content')
    <div class="container">
        <h2 class="text-center" style="color:grey;">Create Supplier</h2>

        <div class="col-6 mx-auto">
            <form action="{{ route('suppliers.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" required>
                </div>

                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('title')
Create Supplier
@endsection

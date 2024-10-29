@extends('layouts.layout')

@section('title')
Create Product
@endsection

@section('content')
<form action="{{ route('products.store') }}" method="post" class="p-4">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" id="price" class="form-control" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-dark">Create</button>
    </div>
</form>
@endsection




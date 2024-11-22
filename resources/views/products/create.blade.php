@extends('layouts.layout')

@section('title')
Create Product
@endsection

@section('content')
<form action="{{ route('products.store') }}" method="post" class="p-4">
    @csrf
    <div class="mb-3">
        <label for="name_km" class="form-label">Product Khmer Name</label>
        <input type="text" name="name_km" id="name_km" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="name_en" class="form-label">Product English Name</label>
        <input type="text" name="name_en" id="name_en" class="form-control" required>
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




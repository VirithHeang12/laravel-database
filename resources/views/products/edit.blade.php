@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2 class="text-center" style="color:grey;">Edit Product</h2>

        <div class="col-6 mx-auto">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="description" name="description" class="form-control" id="description" value="{{ $product->description }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" id="price" value="{{ $product->price }}">
                </div>


                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('title')
    Edit Product
@endsection

@extends('layouts.layout')

@section('title')
Products
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1 class="text-center fw-bold">Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-dark">Create Product</a>
    <table class="table table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th class="py-3" scope="col">ID</th>
                <th class="py-3" scope="col">Product Name</th>
                <th class="py-3" scope="col">Description</th>
                <th class="py-3" scope="col">Price</th>
                <th class="py-3" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-primary btn-sm">Show</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', ['product' => $product]) }}" method="post" onsubmit="return confirm('Are you sure want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection



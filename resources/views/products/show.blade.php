@extends('layouts.layout')

@section('content')
    <div class="container mb-5">
        <h2 class="text-center" style="color: grey;">Show Product</h2>
        <div class="col-6 mx-auto mt-4">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Product Description</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $product->price }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Show Product
@endsection

@extends('layouts.layout')

@section('content')
    <div class="container mb-5">
        <h2 class="text-center" style="color: grey;">Show Supplier</h2>
        <div class="col-6 mx-auto mt-4">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $supplier->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $supplier->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $supplier->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $supplier->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $supplier->address }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Show Supplier
@endsection

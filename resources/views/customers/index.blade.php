@extends('layouts.layout')

@section('content')
@if (session('success'))
        <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div id="success-message" class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1 class="text-center my-4">Customers</h1>
    <div class="row">
        <div class="col-xl-6 col-lg-8 col-md-12 mx-auto">
            <a class="btn btn-dark" href="{{ route('customers.create') }}">Create Customer</a>
            <table class="table table-hover table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th scope="row">{{ $customer->id }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td class="d-flex justify-content-between">
                                <a class="btn btn-info" href="{{ route('customers.show', ['customer' => $customer->id]) }}">Show</a>
                                <a class="btn btn-warning" href="{{ route('customers.edit', ['customer' => $customer->id]) }}">Edit</a>
                                <form action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" method="post" 
                                    onsubmit="return confirm('Are you sure want to delete this customer?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('title')
Customers
@endsection

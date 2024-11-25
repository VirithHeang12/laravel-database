@extends('layouts.layout')

@section('content')
@if (session('success'))
    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div id="success-message" class="alert alert-danger">{{ session('error') }}</div>
@endif

    
    <h1 class="text-center my-5">Customers</h1>
    <div class="row">
        <div class="mx-auto">
            <div class="row gy-4">
                <div class="col-12">
                    <a class="btn btn-dark me-3" href="{{ route('customers.create') }}">Create Customer</a>
                    <a class="btn btn-dark me-3" href="{{ route('customers.createImport') }}">Import Customer</a>
                    <a class="btn btn-dark me-3" href="{{ route('customers.deleted') }}">Show Deleted Customer</a>
                    <a class="btn btn-dark" href="{{ route('customers.exportView') }}">Export Customer</a>
                </div>
                <div class="col-12">
                    <form class="row g-3 justify-content-end" action="{{route('customers.index')}}" method="GET">
                        <div class="col-auto">
                            <input class="form-control" type="text" name="name" id="name" value="{{ request('name') }}" placeholder="Input name to search">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-hover align-middle table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th scope="row">{{ $customer->id }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                <div class="d-flex gap-4">
                                    <a class="btn btn-info" href="{{ route('customers.show', ['customer' => $customer->id]) }}">Show</a>
                                    <a class="btn btn-warning" href="{{ route('customers.edit', ['customer' => $customer->id]) }}">Edit</a>
                                    <form action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" method="post" 
                                        onsubmit="return confirm('Are you sure want to delete this customer?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$customers->links()}}
        </div>
    </div>
@endsection

@section('title')
Customers
@endsection

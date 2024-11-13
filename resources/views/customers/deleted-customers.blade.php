@extends('layouts.layout')

@section('content')
    <h1 class="text-center my-5">Deleted Customers</h1>
    <div class="row">
        <div class="mx-auto">
            <table class="table table-hover align-middle table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th scope="row">{{ $customer->id }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-dark" href="{{ route('customers.index') }}">Back</a>
        </div>
    </div>
@endsection

@section('title')
Customers
@endsection

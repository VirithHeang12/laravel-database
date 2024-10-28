@extends('customers.layouts.layout')

@section('content')
    <h1 class="text-center my-4">Customers</h1>
    <div class="row">
        <div class="col-xl-6 col-lg-8 col-md-12 mx-auto">
            <a class="btn btn-primary" href="{{ route('customers.create') }}">Create Customer</a>
            <table class="table my-4">
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
                            <td class="d-flex justify-content-between">
                                <a class="btn btn-info" href="{{ route('customers.show', ['customer' => $customer->id]) }}">Show</a>
                                <a class="btn btn-warning" href="{{ route('customers.edit', ['customer' => $customer->id]) }}">Edit</a>
                                <form action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" method="post">
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

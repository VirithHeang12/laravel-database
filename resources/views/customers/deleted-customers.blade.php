@extends('layouts.layout')

@section('content')
    <h1 class="text-center my-5">Deleted Customers</h1>
    <div class="row">
        <div class="mx-auto">
            <form action="{{ route('customers.restoreAll') }}" method="POST" class="mb-3"
                    onsubmit="return confirm('Are you sure want to restore all deleted customers?')">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Restore All</button>
            </form>
            <table class="table table-hover align-middle table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone Number</th>
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
                                <form action="{{ route('customers.restore', ['customer' => $customer->id]) }}" method="POST"
                                        onsubmit="return confirm('Are you sure want to restore this deleted customer?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                            </td>
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

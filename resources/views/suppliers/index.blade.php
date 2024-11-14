@extends('layouts.layout')


@section('content')
    <div class="container ">

        @if (session('success'))
            <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div id="success-message" class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h2 class="text-center" style="color: grey">Supplier</h2>
        <div class="d-flex align-items-center justify-content-between">
            <form method="GET" action="{{ route('suppliers.index') }}" class="d-flex">
                <input type="text" class="form-control me-2" name="name" placeholder="Name" value="{{ request('name') }}">
                <input type="text" class="form-control me-2" name="address" placeholder="Address" value="{{ request('address') }}">
                <button type="submit" class="btn btn-secondary">Filter</button>

            </form>
            <a href="{{ route('suppliers.deleted') }}" class="btn btn-dark">Show Deleted Supplier</a>
            <div>
                <a href="{{ route('suppliers.create') }}" class="btn btn-dark">Create Supplier</a>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover text-nowrap mt-5 table-centered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <th scope="row">{{ $supplier->id }}</th>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>
                                <a href="{{ route('suppliers.show', $supplier->id) }}"
                                    class="btn btn-sm btn-primary">Show</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $suppliers->links() }}

        </div>

    </div>
@endsection

@section('title')
    List Suppliers
@endsection

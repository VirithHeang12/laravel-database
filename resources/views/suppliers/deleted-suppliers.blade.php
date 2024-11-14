@extends('layouts.layout')
@section('title')
    Show Delete Suppliers
@endsection

@section('content')
    <div class="container ">
        <h2 class="text-center" style="color: grey">Soft Deleted Suppliers</h2>

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
                                <form action="{{ route('suppliers.restore', ['supplier' => $supplier->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info">Restore</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>

    <a href="{{ route('suppliers.index') }}" class="btn btn-dark">Back</a>
@endsection

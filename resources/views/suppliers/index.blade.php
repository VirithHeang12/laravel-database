@extends('suppliers.layouts.layout');


@section('content')

<div class="container ">
    <h2 class="text-center" style="color: grey">Supplier</h2>
    <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('suppliers.create') }}" type="button" class="btn btn-secondary">Create Supplier</a>
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
                        <th scope="row">{{$supplier->id}}</th>
                        <td>{{$supplier->name}}</td>
                        <td>{{$supplier->email}}</td>
                        <td>{{$supplier->phone}}</td>
                        <td>{{$supplier->address}}</td>
                        <td>
                            <a href="{{ route('suppliers.show', $supplier->id)}}" class="btn btn-sm btn-primary">Show</a>
                            <a href="{{ route('suppliers.edit', $supplier->id)}}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier->id)}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
List Suppliers
@endsection

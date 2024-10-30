@extends('layouts.layout')

@section('content')
    <div class="row justify-content-center">
        <h1 class="my-4 text-center">Customer Detail</h1>
        <div class="col-lg-4 col-md-6 col-12">
        <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th>Customer Name :</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number :</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Created at :</th>
                        <td>{{ $customer->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated at :</th>
                        <td>{{ $customer->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-primary px-4 mt-4" href="{{ route('customers.index') }}">Back</a>
        </div>
    </div>
@endsection

@section('title')
Show Customer
@endsection



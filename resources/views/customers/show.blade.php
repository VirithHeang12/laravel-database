@extends('layouts.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <h1 class="my-4 text-center">Customer Detail</h1>
            <h6>Customer Name : {{ $customer->name }}</h6>
            <h6>Phone Number : {{ $customer->phone }}</h6>
            <h6>Created at : {{ $customer->created_at }}</h6>
            <h6>Updated at : {{ $customer->updated_at }}</h6>
            <a class="btn btn-primary px-4 mt-4" href="{{ route('customers.index') }}">Back</a>
        </div>
    </div>
@endsection

@section('title')
Show Customer
@endsection



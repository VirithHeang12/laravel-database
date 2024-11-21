@extends('layouts.layout')

@section('title')
    Product Logs
@endsection

@section('content')
    <h1 class="text-center fw-bold">Product Logs</h1>

    <table class="table table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th class="py-3" scope="col">ID</th>
                <th class="py-3" scope="col">Log Name</th>
                <th class="py-3" scope="col">Description</th>
                <th class="py-3" scope="col">Subject Type</th>
                <th class="py-3" scope="col">Causer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <th scope="row">{{ $log->id }}</th>
                    <td>{{ $log->log_name }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->subject_type }}</td>
                    <td>{{ $log->causer }}</td>
                    <td>{{ $log->properties }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
    </div>
@endsection



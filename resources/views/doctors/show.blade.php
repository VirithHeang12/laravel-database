@extends('layouts.layout')

@section('title')
    Show Doctor
@endsection

@section('content')
    <div class="container mb-5">
        <h1 class="text-center">Show Doctor</h1>
        <div class="col-6 mx-auto mt-4">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $doctor->id }}</td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td>{{ $doctor->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Specialty</th>
                        <td>{{ $doctor->specialty }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $doctor->phone_number }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection



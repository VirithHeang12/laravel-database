@extends('layouts.layout')

@section('title')
    {{ __('doctors') }}
@endsection

@section('content')
    <h1 class="text-center fw-bold">Deleted Doctors</h1>
    <div class="d-flex justify-content-end">
        <form action="{{ route('doctors.restoreAll') }}" method="POST" onsubmit="return confirm('Are you sure want to restore all deletet doctors?')">
            @csrf
            <button type="submit" class="btn btn-dark">Restore All Deleted Doctors</button>
        </form>
    </div>
    <table class="table table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th class="py-3" scope="col">ID</th>
                <th class="py-3" scope="col">Full name</th>
                <th class="py-3" scope="col">Specialty</th>
                <th class="py-3" scope="col">Phone number</th>
                <th class="py-3" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <th scope="row">{{ $doctor->id }}</th>
                    <td>{{ $doctor->full_name }}</td>
                    <td>{{ $doctor->specialty }}</td>
                    <td>{{ $doctor->phone_number }}</td>
                    <td>
                        <form action="{{ route('doctors.restore', ['doctor' => $doctor->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('doctors.index') }}" class="btn btn-dark">Back</a>
@endsection

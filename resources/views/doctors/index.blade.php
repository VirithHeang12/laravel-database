@extends('layouts.layout')

@section('title')
    Doctors
@endsection

@section('content')
    @if (session('success'))
        <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div id="success-message" class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1 class="text-center fw-bold">Doctors</h1>
    <a href="{{ route('doctors.create') }}" class="btn btn-dark">Create Doctor</a>
    <a href="{{ route('doctors.deleted') }}" class="btn btn-dark">Show Deleted Doctors</a>

    <form action="{{ route('doctors.index') }}" method="GET" class="mt-4 d-flex align-items-center justify-content-between gap-2">
        <input type="text" class="form-control" name="full_name" id="full_name" value="{{ request('full_name') }}" placeholder="Enter name here">

        <select name="specialty" id="specialty" class="form-select">
            <option value="" disabled {{ request('specialty') ? '' : 'selected' }}>Select specialty here</option>
            <option value="Cardiology" {{ request('specialty') == 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
            <option value="Neurology" {{ request('specialty') == 'Neurology' ? 'selected' : '' }}>Neurology</option>
            <option value="Orthopedics" {{ request('specialty') == 'Orthopedics' ? 'selected' : '' }}>Orthopedics</option>
            <option value="General" {{ request('specialty') == 'General' ? 'selected' : '' }}>General</option>
            <option value="Pediatrician" {{ request('specialty') == 'Pediatrician' ? 'selected' : '' }}>Pediatrician</option>
        </select>
        <button type="submit" class="btn btn-outline-dark">Filter</button>
    </form>


    <table class="table table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th class="py-3" scope="col">ID</th>
                <th class="py-3" scope="col">Full name</th>
                <th class="py-3" scope="col">Specialty</th>
                <th class="py-3" scope="col">Phone number</th>
                <th class="py-3" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <th scope="row">{{ $doctor->id }}</th>
                    <td>{{ $doctor->full_name }}</td>
                    <td>{{ $doctor->specialty }}</td>
                    <td>{{ $doctor->phone_number }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('doctors.show', ['doctor' => $doctor->id]) }}"
                            class="btn btn-primary btn-sm">Show</a>
                        <a href="{{ route('doctors.edit', ['doctor' => $doctor->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('doctors.destroy', ['doctor' => $doctor]) }}" method="post"
                            onsubmit="return confirm('Are you sure want to delete this doctor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $doctors->links() }}
@endsection

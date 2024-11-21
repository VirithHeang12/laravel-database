@extends('layouts.layout')

@section('title')
    Import Doctors
@endsection

@section('content')
    <form action="{{ route('doctors.saveImport') }}" method="POST" class="p-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload Sheet File</label>
            <input type="file" name="file" id="file" class="form-control" value="{{ old('model') }}" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-dark mt-4">Import</button>
        </div>
    </form>
@endsection

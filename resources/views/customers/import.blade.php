
@extends('layouts.layout')

@section('title')
    Import Customers
@endsection

@section('content')
    <form action="{{ route('customers.saveImport') }}" method="post" class="p-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload File</label>
            <input type="file" name="file" id="file" class="form-control" value="{{ old('phone') }}" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="text-end mt-4">
            <a class="btn btn-dark" href="{{ route('customers.index') }}">Back</a>
                <button type="submit" class="btn btn-dark">Import</button>
            </div>
        </div>
    </form>
@endsection

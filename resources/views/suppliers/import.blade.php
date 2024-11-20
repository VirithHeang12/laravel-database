
@extends('layouts.layout')

@section('title')
    Import Suppliers
@endsection

@section('content')
    <form action="{{ route('suppliers.saveImport') }}" method="post" class="p-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload File</label>
            <input type="file" name="file" id="file" class="form-control mb-3" value="{{ old('model') }}" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="text-end ">
                <button type="submit" class="btn btn-dark">Import</button>
            </div>
        </div>
    </form>
@endsection


@extends('layouts.layout')

@section('title')
Create Category
@endsection

@section('content')
<div class="row py-4">
<div class="col-6 mx-auto">
<h1 class="text-center mb-5">Create Book</h1>
<form action="{{ route('books.store') }}" method="post" class="p-4">
    @csrf
    <div class="mb-3">
        <label for="book_title" class="form-label">Book Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title')}}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author Name</label>
        <input type="text" name="author" id="author" class="form-control" value="{{ old('author')}}">
        @error('author')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="published_year" class="form-label">Published Year</label>
        <input type="text" name="published_year" id="published_year" class="form-control">
        
    </div>
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" name="genre" id="genre" class="form-control"  value="{{ old('genre')}}">
        @error('genre')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-between">
    <a class="btn btn-outline-dark px-4 mt-4" href="{{ route('books.index') }}">Back</a>
        <button class="btn btn-outline-primary px-4 mt-4" type="submit">Create</button>
    </div>
</form>
</h1>
</div>
</div>
@endsection




@extends('books.layouts.layout')

@section('title')
Create Category
@endsection

@section('content')
<form action="{{ route('books.store') }}" method="post" class="p-4">
    @csrf
    <div class="mb-3">
        <label for="book_title" class="form-label">Book Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author Name</label>
        <input type="text" name="author" id="author" class="form-control">
    </div>
    <div class="mb-3">
        <label for="published_year" class="form-label">Published Year</label>
        <input type="text" name="published_year" id="published_year" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" name="genre" id="genre" class="form-control">
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-dark">Create</button>
    </div>
</form>
@endsection




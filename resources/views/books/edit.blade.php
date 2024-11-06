@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2 class="text-center" style="color:grey;">Edit Book</h2>

        <div class="col-6 mx-auto">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Book Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $book->title }}"
                        required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author Name</label>
                    <input type="name" name="author" class="form-control" id="author" value="{{ $book->author }}"
                        required>
                    @error('author')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Published Year</label>
                    <input type="text" name="published_year" class="form-control" id="pbulished_year" value="{{ $book->published_year }}">
                    @error('published_year')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Genre</label>
                    <input type="text" name="genre" class="form-control" id="genre"
                        value="{{ $book->genre }}">
                    @error('genre')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('title')
    Edit Book
@endsection

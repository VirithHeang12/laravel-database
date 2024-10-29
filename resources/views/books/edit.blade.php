@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2 class="text-center" style="color:grey;">Edit Book</h2>

        <div class="col-6 mx-auto">
            <form action="{{ route('books.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Book Title</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $book->title }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="author_name" class="form-label">Author Name</label>
                    <input type="author_name" name="author" class="form-control" id="author_name" value="{{ $book->author }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="published_year" class="form-label">Published Year</label>
                    <input type="text" name="published_year" class="form-control" id="published_year" value="{{ $book->published_year }}">
                </div>

                <div class="mb-3">
                    <label for="Genre" class="form-Genre">Genre</label>
                    <input type="text" name="genre" class="form-control" id="genre"
                        value="{{ $book->genre }}">
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

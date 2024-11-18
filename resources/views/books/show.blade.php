@extends('layouts.layout')

@section('content')
    <div class="container mb-5">
        <h2 class="text-center fw-bold">Show Book</h2>
        <div class="col-6 mx-auto mt-4">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $book->id }}</td>
                    </tr>
                    <tr>
                        <th>Book Title</th>
                        <td>{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <th>Author Name</th>
                        <td>{{ $book->author }}</td>
                    </tr>
                    <tr>
                        <th>Published Year</th>
                        <td>{{ $book->published_year }}</td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>{{ $book->genre }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Show Book
@endsection

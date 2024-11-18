@extends('layouts.layout')

@section('title')
Books
@endsection

@section('content')
<div class="container ">
@if (session('success'))
            <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div id="success-message" class="alert alert-danger">{{ session('error') }}</div>
        @endif
    <h2 class="text-center fw-bold">Books</h2>
    <div class="d-flex align-items-center justify-content-between">
            <!-- <form method="GET" action="{{ route('books.index') }}" class="d-flex">
                <input type="text" class="form-control me-2" name="title" placeholder="Book Title" value="{{ request('name') }}">
                <button type="submit" class="btn btn-dark">Search</button>
            </form> -->
            <form class="row g-3 justify-content-end" action="{{route('books.index')}}" method="GET">
                        <div class="col-auto">
                            <input class="form-control" type="text" name="title" id="titlte" value="{{ request('title') }}" placeholder="Book Titlte">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark">Search</button>
                        </div>
                    </form>
            <div>
                <a href="{{ route('books.create') }}" class="btn btn-dark">Create Book</a>
                <a href="{{ route('books.deleted') }}" class="btn btn-dark">Show Deleted Book</a>
            </div>
           
        </div>
        <div class="table-responsive">
        <table class="table table-hover text-nowrap mt-5 table-centered">
        <thead class="thead-dark">
            <tr>
                <th class="py-3" scope="col">ID</th>
                <th class="py-3" scope="col">Book Title</th>
                <th class="py-3" scope="col">Author Name</th>
                <th class="py-3" scope="col">Published Year</th>
                <th class="py-3" scope="col">Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <th scope="row">{{ $book->id }}</th>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ $book->genre }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary btn-sm">Show</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="post" onsubmit="return confirm('Are you sure want to delete this book?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $books->links() }}
</div>
</div>
@endsection



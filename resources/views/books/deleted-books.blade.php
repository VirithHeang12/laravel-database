@extends('layouts.layout')
@section('title')
    Show Deleted Books
@endsection

@section('content')
    <div class="container ">
        <h2 class="text-center fw-bold">Soft Deleted Books</h2>

          <form action="{{ route('books.restoreAll') }}" method="POST" class="mb-3">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">Restore All</button>
        </form>

        <div class="table-responsive">
            <table class="table table-hover text-nowrap mt-5 table-centered">
                <thead>
                    <tr>
                        <th class="py-3" scope="col">ID</th>
                        <th class="py-3" scope="col">Book Title</th>
                        <th class="py-3" scope="col">Author Name</th>
                        <th class="py-3" scope="col">Published Year</th>
                        <th class="py-3" scope="col">Genre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <th scope="row">{{ $book->id }}</th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->published_year }}</td>
                            <td>{{ $book->genre }}</td>
                            <td>
                                <form action="{{ route('books.restore', ['book' => $book->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info">Restore</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>

    <a href="{{ route('books.index') }}" class="btn btn-dark">Back</a>
@endsection

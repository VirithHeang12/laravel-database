@extends('layouts.layout')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}">Create Category</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.show', ['category' => $category->id]) }}">Show</a>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}">Edit</a>
                        <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('title')
Categories
@endsection

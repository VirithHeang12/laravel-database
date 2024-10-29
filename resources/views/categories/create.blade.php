@extends('layouts.layout')

@section('content')
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
        <button type="submit">Create</button>
    </form>
@endsection

@section('title')
Create Category
@endsection

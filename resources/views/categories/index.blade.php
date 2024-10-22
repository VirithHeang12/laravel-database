<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
            </ul>
        </nav>
    </header>
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}">Create Category</a>
    <ul>
        @foreach($categories as $category)
            <li>{{ $category->name }}</li>
            <li>
                <a href="{{ route('categories.show', ['category' => $category->id]) }}">Show</a>
                <a href="{{ route('categories.edit', ['category' => $category->id]) }}">Edit</a>
                <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>


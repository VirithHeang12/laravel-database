<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Category</title>
</head>
<body>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
        <button type="submit">Create</button>
    </form>
</body>
</html>

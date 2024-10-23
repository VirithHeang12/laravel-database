
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to Our Application</h1>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            {{-- <li><a href="{{ route('about') }}">About</a></li> --}}
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li><a href="{{ route('products.index') }}">Products</a></li>
        </ul>
    </nav>
</body>
</html>

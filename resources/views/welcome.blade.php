
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <header>
        <h1>Home Page</h1>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('customers.index') }}">Customers</a></li>
                <li><a href="{{ route('doctors.index') }}">Doctors</a></li>
                <li><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>

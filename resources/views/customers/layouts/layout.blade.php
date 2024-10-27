<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title', 'Laravel 11 CRUD Example')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <ul class="d-flex gap-4 list-unstyled">
                    <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
                    <li><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                    <li><a class="nav-link" href="{{ route('customers.index') }}">Customers</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container mx-auto">
            @yield('content')
        </div>
    </main>
    <footer>
        <hr class="my-5">
        <h4 class="text-center">&copy; 2020</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


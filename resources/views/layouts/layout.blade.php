<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title', 'Laravel 11 CRUD Example')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap');

        body {
            font-family: 'Kantumruy Pro', sans-serif;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-dark bg-dark mb-3">
            <div class="container">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('doctors.index') }}">Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suppliers.index') }}">Suppliers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cars.index') }}">Cars</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>



    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer class="container">
        <p>&copy; Copyright 2024</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // Wait for the page to load
        document.addEventListener("DOMContentLoaded", function() {
            // Select the success message div
            const successMessage = document.getElementById('success-message');

            // If it exists, set a timeout to hide it after 2 seconds (2000ms)
            if (successMessage) {
                setTimeout(() => {
                    // Fade out by setting the opacity to 0
                    successMessage.style.transition = 'opacity 0.5s ease';
                    successMessage.style.opacity = '0';

                    // Remove the element from the DOM after the fade-out
                    setTimeout(() => successMessage.remove(), 500);
                }, 2000);
            }
        });
    </script>
</body>

</html>

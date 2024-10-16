<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>
<body>
    @foreach ($products as $product)
        <h1>{{ $product->name }}</hjson>
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}</p>
    @endforeach
</body>
</html>

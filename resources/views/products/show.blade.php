<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>{{ $product->prod_name }}</h1>

        <div class="mb-4">
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="img-fluid" style="max-width: 500px; max-height: 500px;">
        </div>


        <p><strong>Amount:</strong> {{ $product->amount }}</p>
        <p><strong>Price:</strong> ₱{{ $product->price }}</p>

        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</body>
</html>

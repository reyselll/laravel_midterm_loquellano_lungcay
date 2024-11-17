<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product-img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            max-height: 200px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('jetian.png') }}" alt="Logo" class="logo">

    <div class="container mt-4">
        <h1 class="mb-4">Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="product-img">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->prod_name }}</td>
                            <td>{{ $product->amount }}</td>
                            <td>₱{{ number_format($product->price, 2) }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

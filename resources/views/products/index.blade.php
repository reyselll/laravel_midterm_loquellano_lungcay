<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #cda548; /* Black background */
            color: #fff; /* White text for body */
        }
        .product-img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .logo {
            width: 170px;
            height: auto;
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        /* Table Styles */
        .table {
            border-color: #8B4513; /* Brown border */
        }
        .table th {
            background-color: #8B4513; /* Brown header */
            color: white; /* White text in table header */
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #e1dada; /* Dark grey for odd rows */
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #8B4513; /* Brown border */
        }

        /* Button Styles */
        .btn-primary {
            background-color: #8B4513; /* Brown for primary button */
            border-color: #8B4513;
        }
        .btn-primary:hover {
            background-color: #6a3e1b; /* Darker brown on hover */
            border-color: #6a3e1b;
        }
        .btn-info {
            background-color: #2c1414; /* Dark grey for info button */
            border-color: #1d1212;
        }
        .btn-warning {
            background-color: #b46236; /* Gold for warning button */
            border-color: #bf5b29;
        }
        .btn-danger {
            background-color: #a10000; /* Red for danger button */
            border-color: #a10000;
        }
        /* Button Hover Effects */
        .btn-info:hover {
            background-color: #321f1f;
            border-color: #4a2121;
        }
        .btn-warning:hover {
            background-color: #b88e00;
            border-color: #b88e00;
        }
        .btn-danger:hover {
            background-color: #8b0000;
            border-color: #8b0000;
        }
    </style>
</head>
<body>
    <img src="{{ asset('logo.png') }}" alt="Logo" class="logo">

    <div class="container mt-4">
        <h1 class="mb-4">Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
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
                            <td>{{ $product->quantity }}</td>
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

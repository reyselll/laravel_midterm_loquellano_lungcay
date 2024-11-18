<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
            background-color: #c9701d; /* Gold for warning button */
            border-color: #bb6311;
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
    <div class="container mt-4">
        <h1>Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="prod_name">Product Name</label>
                <input type="text" name="prod_name" class="form-control" value="{{ htmlspecialchars($product->prod_name) }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ htmlspecialchars($product->quantity) }}" required min="1">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ htmlspecialchars($product->price) }}" required min="1">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

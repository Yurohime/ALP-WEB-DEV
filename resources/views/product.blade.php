@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Product Detail</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .big-image {
            max-width: 80%; /* Adjust the percentage as needed */
            margin: auto; /* Center the image horizontally */
            display: block; /* Ensure the image doesn't overflow its container */
        }

        .product-details {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top: 20px;
            font-family: 'Arial', sans-serif; /* Change font */
            font-size: 18px; /* Increase font size */
        }

        .btn-pink {
            background-color: pink;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <!-- Big Image -->
                <img src="{{ asset('images/' . $product->main_gambar) }}" class="img-fluid big-image" >
            </div>
            <div class="col-md-4">
                <!-- Product Details -->
                <div class="product-details">
                    <h3 class="mb-3">{{ $product->nama_produk }}</h3>
                    <p class="mb-3">{{ $product->deskripsi }}</p>
                    <p class="mb-3">Cost: Rp {{ number_format($product->harga_beli, 0, ',', '.') }},-</p>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('product.addToCart', $product->id_produk) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-pink mb-2">Add to Cart</button>
                    </form>

                    <!-- Add to Wishlist Form -->
                    <form action="{{ route('product.addToWishlist', $product->id_produk) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-pink mb-2">Add to Wishlist</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection

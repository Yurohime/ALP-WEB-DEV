@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('home.css') }}" rel="stylesheet">
    <style>
        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%; /* Ensures all cards have the same height */
        }
        .card-body {
            flex-grow: 1; /* Takes up remaining space inside the card */
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        .card-text, .card-title {
            margin-bottom: 1rem;
        }
        .btn {
            margin-top: auto; /* Push the button to the bottom */
        }
        .col-md-4{
            height: 600px;
        }
        .card a img{
            height: 400px;
        }
    </style>
</head>
<body>
    <h1 class="text-center mt-1">Products</h1>
    <div class="container-fluid mt-3">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 border">
                        <a href="{{ route('product', ['id' => $product->id_produk]) }}">
                            <img src="http://127.0.0.1:8000/images/{{ $product->main_gambar }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama_produk }}</h5>
                            <p class="card-text">Cost: Rp {{ number_format($product->harga_beli, 0, ',', '.') }},-</p>
                            <!-- Add to Cart button -->
                            <button class="btn btn-primary add-to-cart mt-auto" data-product-id="{{ $product->id_produk }}">Add to Cart</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $products->links('custom-pagination') }}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event listener for Add to Cart buttons
            document.querySelectorAll('.add-to-cart').forEach(function(button) {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    // Perform the add-to-cart action here
                    alert('Product ' + productId + ' added to cart!');
                    // You can make an AJAX request to add the product to the cart
                });
            });
        });
    </script>
</body>
</html>

@endsection

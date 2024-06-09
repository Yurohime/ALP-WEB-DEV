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
        .big-image-container {
            position: relative;
            overflow: hidden;
            max-width: 70%; /* Adjust the maximum width as needed */
            margin: auto; /* Center the container horizontally */
        }

        .big-image {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .magnifying-glass {
            position: absolute;
            width: 150px;
            height: 150px;
            border: 2px solid #fff;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.1);
            cursor: none;
            display: none;
        }

        .big-image-container:hover .magnifying-glass {
            display: block;
        }

        .magnified-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: 200% 200%; /* Twice the size of the magnifying glass */
            background-repeat: no-repeat;
            background-position: center center;
            transition: background-position 0.2s;
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

        .small-images {
            display: flex;
            justify-content: space-between; /* Align items with space between them */
            align-items: center; /* Align items vertically */
            flex-wrap: wrap; /* Allow items to wrap to the next line if necessary */
        }

        .small-image {
            width: 100px; /* Adjust the width of the smaller images */
            height: auto;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <!-- Big Image Container -->
                <div class="big-image-container">
                    <!-- Big Image -->
                    <img src="{{ asset('images/' . $product->main_gambar) }}" class="big-image" id="bigImage">
                    <!-- Magnifying Glass -->
                    <div class="magnifying-glass"></div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Small Images -->
                <div class="small-images">
                    <img src="{{ asset('images/' . $product->main_gambar) }}" class="small-image" onclick="changeBigImage(this)">
                    <img src="{{ asset('images/' . $product->sub_gambar1) }}" class="small-image" onclick="changeBigImage(this)">
                    <img src="{{ asset('images/' . $product->sub_gambar2) }}" class="small-image" onclick="changeBigImage(this)">
                    <img src="{{ asset('images/' . $product->sub_gambar3) }}" class="small-image" onclick="changeBigImage(this)">
                </div>
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

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const bigImage = document.querySelector('.big-image');
            const bigImageContainer = document.querySelector('.big-image-container');

            bigImageContainer.addEventListener('mousemove', function (e) {
                const { left, top, width, height } = this.getBoundingClientRect();
                const { clientX, clientY } = e;

                const x = (clientX - left) / width * 100;
                const y = (clientY - top) / height * 100;

                bigImage.style.transformOrigin = `${x}% ${y}%`;
                bigImage.style.transform = 'scale(2)'; // Increase scale by 200%
            });

            bigImageContainer.addEventListener('mouseleave', function () {
                bigImage.style.transform = 'scale(1)'; // Reset scale when mouse leaves the container
            });
        });

        function changeBigImage(image) {
            // Get the source of the clicked small image
            var src = image.src;
            // Set the source of the big image to the clicked small image source
            document.getElementById('bigImage').src = src;
        }
    </script>
</body>
</html>
@endsection

@extends('layouts.adminapp')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('home.css') }}" rel="stylesheet">
    <style>
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .card-text, .card-title {
            margin-bottom: 1rem;
        }
        .btn {
            margin-top: auto; /* Push the button to the bottom */
        }
        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1 class="text-center mt-1">Products</h1>
    <div class="container-fluid mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 border">
                        <a href="{{ route('product', ['id' => $product->id_produk]) }}">
                            <img src="{{ asset('images/' . $product->main_gambar) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <form action="{{ route('admin.products.update', $product->id_produk) }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="text" class="form-control mb-2" name="name" value="{{ $product->nama_produk }}" placeholder="Product Name">
                                <textarea class="form-control mb-2" name="description" placeholder="Product Description">{{ $product->deskripsi }}</textarea>
                                <input type="number" class="form-control mb-2" name="cost" value="{{  number_format($product->harga_beli, 0, ',', '.') }}" placeholder="Cost (Rp)">
                                <input type="number" class="form-control mb-2" name="stock" value="{{ $product->stok }}" placeholder="Stock">
                                <!-- Save Changes button -->
                                <button type="submit" class="btn btn-primary mt-auto">Save Changes</button>
                            </form>
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
</body>
</html>
@endsection

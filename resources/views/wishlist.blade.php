@extends('layouts.app')

@section('content')
<style>
    .card {
        margin-right: 20px;
        width: 300px;
    }

    .wishlist-row {
        overflow-x: auto;
        white-space: nowrap;
    }

    .remove-from-wishlist-form button {
        color: #dc3545;
        border-color: #dc3545;
    }

    .add-to-cart-form {
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="container">
    <div class="row wishlist-row">
        @foreach($wishlistItems as $product)
        <div class="col-auto mb-4">
            <div class="card">
                <img src="{{ asset('images/' . $product->main_gambar) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama_produk }}</h5>
                    <form action="{{ route('wishlist.add') }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $product->id_produk }}">
                        <button type="submit" class="btn btn-primary btn-sm mr-2">Add to Cart</button>
                    </form>
                    <form action="{{ route('wishlist.remove') }}" method="POST" class="remove-from-wishlist-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id_produk" value="{{ $product->id_produk }}">
                        <button type="submit" class="btn btn-outline-danger btn-sm">Remove from Wishlist</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

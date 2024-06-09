@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style for the image container */
        .image-container {
            width: 100px; /* Adjust image container width */
        }
        /* Style for the item container */
        .item-container {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Align items and quantity button */
            margin-bottom: 20px; /* Adjust item container margin */
        }
        /* Style for the quantity input */
        .quantity-input {
            width: 70px;
            margin-top: 10px; /* Move quantity input lower */
        }
        /* Style for the form container */
        .form-container {
            border: 1px solid #ddd; /* Border color */
            padding: 20px;
            border-radius: 5px;
            margin-left: 20px; /* Adjust form container margin */
        }
        /* Style for the button */
        .btn-action {
            width: 100%; /* Full width button */
        }
        /* Style for the total form */
        .total-form {
            margin-top: 20px; /* Adjust margin top */
            font-size: 20px; /* Increase font size */
        }
        /* Style for the sub-total */
        .sub-total {
            margin-bottom: 10px; /* Add space between sub-totals */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Left side: Item list -->
        <div class="col-md-8">
            <h2>Cart</h2>
            @if($cartItems->isEmpty())
                <p>Cart is currently empty</p>
            @else
                @foreach($cartItems as $item)
                    <div class="item-container">
                        <div class="image-container mr-3">
                            <img src="{{ asset('images/' . $item->main_gambar) }}" class="img-fluid" alt="Item Image">
                        </div>
                        <div>
                            <h4>{{ $item->nama_produk }}</h4>
                            <p>Description: {{ $item->deskripsi }}</p>
                            <p>Price: Rp. {{ number_format($item->harga_jual, 0, ',', '.') }},-</p>
                        </div>
                        <!-- Quantity button -->
                        <input type="number" value="{{ $item->kuantitas }}" min="1" class="form-control quantity-input" data-order-id="{{ $item->id_order }}" data-product-id="{{ $item->id_produk }}">
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Right side: Form for total amount -->
        <div class="col-md-4">
            @if(!$cartItems->isEmpty())
                <div class="form-container">
                    <h4>Sub-Totals</h4>
                    @foreach($cartItems as $item)
                        <div class="sub-total">{{ $item->nama_produk }}: Rp. {{ number_format($item->harga_jual * $item->kuantitas, 0, ',', '.') }},-</div>
                    @endforeach
                    <!-- Total -->
                    <h4>Total Amount</h4>
                    <form class="total-form">
                        <div class="form-group">
                            <label>Total:</label>
                            @php
                                $total = $cartItems->sum(function($item) {
                                    return $item->harga_jual * $item->kuantitas;
                                });
                            @endphp
                            <input type="text" class="form-control" id="totalAmount" value="Rp. {{ number_format($total, 0, ',', '.') }},-" readonly>
                        </div>
                        <!-- Button to Clear or Checkout -->
                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('checkout') }}" class="btn btn-success btn-action">Checkout</a>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- AJAX to handle quantity changes -->
<script>
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const orderId = this.getAttribute('data-order-id');
            const productId = this.getAttribute('data-product-id');
            const quantity = this.value;

            fetch('{{ route('cart.updateQuantity') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: orderId,
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalAmount').value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(data.total) + ',-';
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

</body>
</html>
@endsection

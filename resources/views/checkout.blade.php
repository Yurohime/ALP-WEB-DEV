@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for wider form */
        .custom-container {
            max-width: 1200px; /* Adjust as needed */
            margin: 0 auto; /* Center the container */
        }
        .col-md-10 {
            width: 600px;
            margin-left: 50%;
        }
    </style>
</head>
<body>

<div class="container mt-5 custom-container">
    <div class="row">
        <div class="col-md-10 offset-md-1"> <!-- Adjusted width -->
            <h2>Checkout</h2>
            <div class="card">
                <div class="card-header">
                    Billing Information
                </div>
                <div class="card-body">
                    <form id="checkoutForm" action="{{ route('checkout.submit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->nama_pelanggan ?? '' }}" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email_pelanggan ?? '' }}" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->notelp_pelanggan ?? '' }}" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group">
                            <label for="payment">Payment Method:</label>
                            <select class="form-control" id="payment" name="payment">
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address">{{ $user->alamat_pelanggan ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
@endsection

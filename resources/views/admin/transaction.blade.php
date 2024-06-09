@extends('layouts.adminapp')

@section('content')
    <div class="container">
        <h1 class="my-4">Transaction List</h1>
        
        <!-- Filter Buttons -->
        <div class="mb-4">
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary">All</a>
            <a href="{{ route('admin.transactions.yearly') }}" class="btn btn-secondary">Yearly</a>
            <a href="{{ route('admin.transactions.monthly') }}" class="btn btn-secondary">Monthly</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Item bought</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td><a href="{{ route('admin.transactions.show', $transaction->id_transaksi) }}">{{ $transaction->product_name }}</a></td>
                            <td>{{ $transaction->customer_name }}</td>
                            <td>{{ $transaction->tanggal_pembayaran }}</td>
                            <td>{{ $transaction->kuantitas }}</td>
                            <td>{{ $transaction->harga_jual * $transaction->kuantitas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

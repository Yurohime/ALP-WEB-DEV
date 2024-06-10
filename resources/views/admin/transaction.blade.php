@extends('layouts.adminapp')

@section('content')
    <style>
        .table-container {
            margin-left: 300px;
            margin-right: 300px;
        }
        .header-section{
            margin-left: 300px;
            margin-right: 300px; 
        }
    </style>

    <div class="header-section d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4">Transaction List</h1>
        <div class="btn-group" role="group" aria-label="Transaction Filters">
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-lg btn-primary">All</a>
            <a href="{{ route('admin.transactions.yearly') }}" class="btn btn-lg btn-secondary">Yearly</a>
            <a href="{{ route('admin.transactions.monthly') }}" class="btn btn-lg btn-secondary">Monthly</a>
        </div>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Item Bought</th>
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
                            <td>{{ \Carbon\Carbon::parse($transaction->tanggal_pembayaran)->format('d M Y') }}</td>
                            <td>{{ $transaction->kuantitas }}</td>
                            <td>${{ number_format($transaction->harga_jual * $transaction->kuantitas, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right font-weight-bold">Total</td>
                        <td class="font-weight-bold">
                            ${{ number_format($transactions->sum(function($transaction) { return $transaction->harga_jual * $transaction->kuantitas; }), 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

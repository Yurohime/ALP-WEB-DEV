@extends('layouts.adminapp')

@section('content')
    <div class="container">
        <h1 class="my-4">Transaction Detail</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactionDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->nama_produk }}</td>
                            <td>{{ $detail->kuantitas }}</td>
                            <td>{{ $detail->harga_jual }}</td>
                            <td>{{ $detail->harga_jual * $detail->kuantitas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary">Back to Transactions</a>
    </div>
@endsection

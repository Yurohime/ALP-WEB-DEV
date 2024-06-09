<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\OrderDetail;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function index()
    {
        // Get user data from session
        $userId = Session::get('user_id');
        $user = Pelanggan::where('id_pelanggan', $userId)->first();

        // Logic to load the checkout page
        return view('checkout', compact('user'));
    }

    public function submit(Request $request)
    {

        
        $uniquetransid = "T".uniqid();

        $userId = Session::get('user_id');


        // Create new transaction
        $transaction = new Transaksi();
        $transaction->id_transaksi = $uniquetransid;
        $transaction->id_pelanggan = $userId;
        $transaction->jenis_pembayaran = $request->input('payment');
        $transaction->nomer_telp = $request->input('phone');
        $transaction->email = $request->input('email');
        $transaction->tanggal_pembayaran = Carbon::now();
        $transaction->save();

        // Get order details for the user
        $orderDetails = OrderDetail::join('order', 'order.id_order', '=', 'order_detail.id_order')
            ->where('order.id_pelanggan', $userId)
            ->where('order.status_pesanan', 'P')
            ->get();

        // Create transaction details
        foreach ($orderDetails as $orderDetail) {
            $transactionDetail = new TransaksiDetail();
            $transactionDetail->id_produk = $orderDetail->id_produk;
            $transactionDetail->id_transaksi = $uniquetransid;
            $transactionDetail->kuantitas = $orderDetail->kuantitas;
            $transactionDetail->harga_jual = $orderDetail->harga_jual;
            $transactionDetail->save();
        }

        // Update order status to completed
        DB::table('order')
            ->where('id_pelanggan', (string)$userId)
            ->where('status_pesanan', 'P')
            ->update(['status_pesanan' => 'C']);

            

        // Redirect to product page with success message
        return redirect()->intended('/customer/home')->with('success', 'Checkout completed successfully.');
    }
}

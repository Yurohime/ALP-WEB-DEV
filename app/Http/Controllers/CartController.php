<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $customerId = Session::get('user_id');

        // Fetch cart items for the current user
        $cartItems = DB::table('order_detail')
            ->join('order', 'order_detail.id_order', '=', 'order.id_order')
            ->join('produk', 'order_detail.id_produk', '=', 'produk.id_produk')
            ->where('order.id_pelanggan', $customerId)
            ->where('order.status_pesanan', 'P')
            ->select('produk.nama_produk', 'produk.deskripsi', 'produk.main_gambar', 'order_detail.kuantitas', 'order_detail.harga_jual', 'order_detail.id_order', 'order_detail.id_produk')
            ->get();

        return view('cart', ['cartItems' => $cartItems]);
    }

    public function updateQuantity(Request $request)
    {
        $customerId = Session::get('user_id');
        $orderId = $request->input('order_id');
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Update the quantity in the database
        DB::table('order_detail')
            ->where('id_order', $orderId)
            ->where('id_produk', $productId)
            ->update(['kuantitas' => $quantity]);

        // Recalculate the total
        $cartItems = DB::table('order_detail')
            ->join('order', 'order_detail.id_order', '=', 'order.id_order')
            ->where('order.id_pelanggan', $customerId)
            ->where('order.status_pesanan', 'P')
            ->select('order_detail.kuantitas', 'order_detail.harga_jual')
            ->get();

        $total = $cartItems->sum(function($item) {
            return $item->harga_jual * $item->kuantitas;
        });

        return response()->json(['total' => $total]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $userId = Session::get('user_id');
        $wishlistItems = DB::table('wishlist')
            ->join('produk', 'wishlist.id_produk', '=', 'produk.id_produk')
            ->where('wishlist.id_pelanggan', $userId)
            ->select('produk.id_produk', 'produk.nama_produk', 'produk.main_gambar', 'produk.harga_beli')
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        $userId = Session::get('user_id');
        $productId = $request->input('id_produk');

        DB::table('wishlist')->insert([
            'id_produk' => $productId,
            'id_pelanggan' => $userId,
        ]);

        return redirect()->route('wishlist')->with('success', 'Product added to wishlist!');
    }

    public function remove(Request $request)
    {
        $userId = Session::get('user_id');
        $productId = $request->input('id_produk');

        DB::table('wishlist')
            ->where('id_pelanggan', $userId)
            ->where('id_produk', $productId)
            ->delete();

        return redirect()->route('wishlist')->with('success', 'Product removed from wishlist!');
    }
}

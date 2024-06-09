<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function show($id)
    {
        // Fetch the product by its ID
        $product = Produk::findOrFail($id);

        // Pass the product to the view
        return view('customer.product', ['product' => $product]);
    }

    public function addToCart(Request $request, $id)
    {
        // Get the product and customer ID from the session
        $productId = $id;
        $customerId = Session::get('user_id');

        // Insert into the order table
        $orderId = 'ORD' . uniqid(); // Generate a unique order ID

        DB::table('order')->insert([
            'id_order' => $orderId,
            'id_pelanggan' => $customerId,
            'order_date' => now(),
            'status_pesanan' => 'P' // P for Pending
        ]);

        // Insert into the order_detail table
        DB::table('order_detail')->insert([
            'id_produk' => $productId,
            'id_order' => $orderId,
            'kuantitas' => 1, // Default quantity
            'harga_jual' => Produk::findOrFail($productId)->harga_beli
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function addToWishlist(Request $request, $id)
    {
        // Get the product and customer ID from the session
        $productId = $id;
        $customerId = Session::get('user_id');

        // Insert into the wishlist table
        DB::table('wishlist')->insert([
            'id_produk' => $productId,
            'id_pelanggan' => $customerId
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully.');
    }

    public function index()
    {
        // Fetch products from the database with pagination
        $products = Produk::paginate(10);
        return view('home', compact('products'));
    }

    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Produk::findOrFail($id);
        
        // Update product details
        $product->nama_produk = $request->input('name');
        $product->deskripsi = $request->input('description');
        $product->harga_beli = $request->input('cost');
        $product->stok = $request->input('stock');
        
        // Save the updated product
        $product->save();

        // Redirect back with a success message
        return redirect()->route('admin.home')->with('success', 'Product updated successfully');
    }
}


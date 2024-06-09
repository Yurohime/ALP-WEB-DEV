<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    

    public function customerHome()
{
    $products = Produk::paginate(4); // Fetch 4 products per page

    return view('home', compact('products')); // Assuming your view is in the 'customer' folder
}

public function adminHome()
    {
        // Fetch product data from the database
        $products = Produk::paginate(4);

        // Render admin home page with product data
        return view('admin.home', compact('products'));
    }

    public function updateProduct(Request $request, $id)
    {
        // Validate incoming request data if necessary

        // Find the product by ID
        $product = Produk::findOrFail($id);

        // Update product data
        $product->nama_produk = $request->input('nama_produk');
        $product->description = $request->input('description');
        $product->harga_beli = $request->input('harga_beli');
        $product->stok = $request->input('stok');

        // Save the changes
        $product->save();

        // Redirect back with a success message or handle the response as needed
        return redirect()->back()->with('success', 'Product updated successfully!');
    }
public function index(Request $request)
    {
        // Check if the user_id_cookie exists
        $user_id = Cookie::get('user_id_cookie');

        if ($user_id != 0) {
            Session::put('user_id', $user_id);
            return redirect()->route('home');
        }

        $products = Produk::paginate(4);
        return view('guest.home', compact('products')); // If no cookie, show guest home
    }

    
}
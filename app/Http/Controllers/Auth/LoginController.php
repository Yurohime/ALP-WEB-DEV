<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->flush(); // Clear the session
        return redirect()->route('login'); // Redirect to the login page after logout
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Check if the user exists in the admin table
        $admin = Admin::where('user_admin', $credentials['username'])
                        ->where('password_admin', $credentials['password'])
                        ->first();

        // Check if the user exists in the pelanggan table
        $pelanggan = Pelanggan::where('email_pelanggan', $credentials['username'])
                                ->where('password_pelanggan', $credentials['password'])
                                ->first();

        if ($admin) {
            // Admin logged in
            // Store admin session
            $request->session()->put('admin_id', $admin->id);
            $request->session()->put('user_type', 'admin');
            return redirect()->intended('/admin/dashboard');
        } elseif ($pelanggan) {
            // Customer logged in
            // Store customer session
            $request->session()->put('pelanggan_id', $pelanggan->id);
            $request->session()->put('user_type', 'pelanggan');
            return redirect()->intended('/customer/dashboard');
        } else {
            // User does not exist or invalid credentials
            return back()->withInput()->withErrors(['username' => 'Invalid username or password.']);
        }
    }
}

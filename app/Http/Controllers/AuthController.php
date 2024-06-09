<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $username = Cookie::get('username');
        $password = Cookie::get('password');
        $login_as = Cookie::get('login_as');
        $remember = !is_null($username) && !is_null($password);

        return view('login', compact('username', 'password', 'login_as', 'remember'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password', 'login_as');
        $remember = $request->has('remember');

        if ($credentials['login_as'] === 'admin') {
            $admin = Admin::where('user_admin', $credentials['username'])
                          ->where('password_admin', $credentials['password'])
                          ->first();

            if ($admin) {
                Session::put('user_id', $admin->id_admin);
                Session::put('username', $admin->user_admin);
                
                if ($remember) {
                    Cookie::queue('username', $credentials['username'], 60 * 24 * 30); // Store for 30 days
                    Cookie::queue('password', $credentials['password'], 60 * 24 * 30); // Store for 30 days
                    Cookie::queue('login_as', $credentials['login_as'], 60 * 24 * 30); // Store for 30 days
                    Cookie::queue('user_id_cookie', $admin->id_admin, 60 * 24 * 30); 
                }

                return redirect()->intended('/admin/dashboard');
            }
        } elseif ($credentials['login_as'] === 'customer') {
            $pelanggan = Pelanggan::where('nama_pelanggan', $credentials['username'])
                                  ->where('password_pelanggan', $credentials['password'])
                                  ->first();

            if ($pelanggan) {
                Session::put('user_id', $pelanggan->id_pelanggan);
                Session::put('username', $pelanggan->nama_pelanggan);
                
                if ($remember) {
                    Cookie::queue('username', $credentials['username'], 60 * 24 * 30); // Store for 30 days
                    Cookie::queue('password', $credentials['password'], 60 * 24 * 30); // Store for 30 days
                    Cookie::queue('login_as', $credentials['login_as'], 60 * 24 * 30); // Store for 30 days
                    Cookie::queue('user_id_cookie', $pelanggan->id_pelanggan, 60 * 24 * 30); 
                }

                return redirect()->intended('/customer/home');
            }
        }

        return back()->withInput()->withErrors(['username' => 'Invalid username or password.']);
    }
}

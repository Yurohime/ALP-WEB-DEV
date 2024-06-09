<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {

        $uniqueusersid = "CUST".uniqid();

        return DB::table('pelanggan')->insert([
            'id_pelanggan' => $uniqueusersid,
            'nama_pelanggan' => $data['name'],
            'email_pelanggan' => '-',
            'password_pelanggan' => $data['password'],
            'alamat_pelanggan' => '-',
            'notelp_pelanggan' => '-',
        ]);
    }
}

 
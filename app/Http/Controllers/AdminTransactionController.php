<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi; // Make sure to import your Transaction model

class AdminTransactionController extends Controller
{
    public function index()
{
    // Fetch transactions from the database
    $transactions = Transaksi::all(); // Replace with your actual data fetching logic

    // Return the transactions view
    return view('admin.transaction', compact('transactions'));
}

    public function show()
    {
        // No data fetching needed for now

        // Return the transaction view
        return view('admin.transaction');
    }
}

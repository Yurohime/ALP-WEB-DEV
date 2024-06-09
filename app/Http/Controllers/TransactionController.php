<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Customer;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaksi::join('transaksi_detail', 'transaksi.id_transaksi', '=', 'transaksi_detail.id_transaksi')
                                 ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                                 ->select('transaksi.*', 'transaksi_detail.*', 'pelanggan.nama_pelanggan as customer_name')
                                 ->get();

        return view('admin.transaction', compact('transactions'));
    }

    public function yearly()
    {
        $transactions = Transaksi::join('transaksi_detail', 'transaksi.id_transaksi', '=', 'transaksi_detail.id_transaksi')
                                 ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                                 ->whereYear('transaksi.tanggal_pembayaran', date('Y'))
                                 ->select('transaksi.*', 'transaksi_detail.*', 'pelanggan.nama_pelanggan as customer_name')
                                 ->get();

        return view('admin.transaction', compact('transactions'));
    }

    public function monthly()
    {
        $transactions = Transaksi::join('transaksi_detail', 'transaksi.id_transaksi', '=', 'transaksi_detail.id_transaksi')
                                 ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                                 ->whereMonth('transaksi.tanggal_pembayaran', date('m'))
                                 ->whereYear('transaksi.tanggal_pembayaran', date('Y'))
                                 ->select('transaksi.*', 'transaksi_detail.*', 'pelanggan.nama_pelanggan as customer_name')
                                 ->get();

        return view('admin.transaction', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaksi::where('id_transaksi', $id)
                                ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                                ->first();

        $transactionDetails = TransaksiDetail::where('id_transaksi', $id)
                                             ->join('products', 'transaksi_detail.id_produk', '=', 'products.id_produk')
                                             ->get();

        return view('admin.transaction_detail', compact('transaction', 'transactionDetails'));
    }
}

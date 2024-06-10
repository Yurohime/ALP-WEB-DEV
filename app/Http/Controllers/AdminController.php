<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
class AdminController extends Controller
{
    public function dashboard()
    {
        // Transaction History Data
        $transactionHistory = Transaksi::select(DB::raw('DATE(tanggal_pembayaran) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $transactionHistoryLabels = $transactionHistory->pluck('date')->toArray();
        $transactionHistoryData = $transactionHistory->pluck('count')->toArray();

        // Transaction Breakdown Data
        $transactionBreakdown = Transaksi::select('jenis_pembayaran', DB::raw('count(*) as count'))
            ->groupBy('jenis_pembayaran')
            ->get();
        $transactionBreakdownLabels = $transactionBreakdown->pluck('jenis_pembayaran')->toArray();
        $transactionBreakdownData = $transactionBreakdown->pluck('count')->toArray();

        // Revenue Distribution Data (total sales per product)
        $revenueDistribution = Produk::join('transaksi_detail', 'produk.id_produk', '=', 'transaksi_detail.id_produk')
            ->select('produk.nama_produk', DB::raw('sum(transaksi_detail.kuantitas * transaksi_detail.harga_jual) as total'))
            ->groupBy('produk.nama_produk')
            ->get();
        $revenueDistributionLabels = $revenueDistribution->pluck('nama_produk')->toArray();
        $revenueDistributionData = $revenueDistribution->pluck('total')->toArray();


        // Product Sales Data (total sales per product)
        $productSales = Produk::join('transaksi_detail', 'produk.id_produk', '=', 'transaksi_detail.id_produk')
            ->select('produk.nama_produk', DB::raw('sum(transaksi_detail.kuantitas) as total'))
            ->groupBy('produk.nama_produk')
            ->get();
        $productSalesLabels = $productSales->pluck('nama_produk')->toArray();
        $productSalesData = $productSales->pluck('total')->toArray();

        return view('admin.dashboard', compact(
            'transactionHistoryLabels', 'transactionHistoryData',
            'transactionBreakdownLabels', 'transactionBreakdownData',
            'revenueDistributionLabels', 'revenueDistributionData',
            'productSalesLabels', 'productSalesData'
        ));

        return view('admin.dashboard', compact(
            'transactionHistoryLabels', 
            'transactionHistoryData',
            'transactionBreakdownLabels',
            'transactionBreakdownData'
        ));
    }
}

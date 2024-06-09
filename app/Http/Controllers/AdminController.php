<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch data for transaction history
        $transactions = Transaksi::selectRaw('DATE(tanggal_pembayaran) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $transactionHistoryLabels = $transactions->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });
        $transactionHistoryData = $transactions->pluck('count');

        // Fetch data for transaction breakdown
        $transactionBreakdown = Transaksi::selectRaw('jenis_pembayaran, COUNT(*) as count')
            ->groupBy('jenis_pembayaran')
            ->get();

        $transactionBreakdownLabels = $transactionBreakdown->pluck('jenis_pembayaran');
        $transactionBreakdownData = $transactionBreakdown->pluck('count');

        return view('admin.dashboard', compact(
            'transactionHistoryLabels', 
            'transactionHistoryData',
            'transactionBreakdownLabels',
            'transactionBreakdownData'
        ));
    }
}

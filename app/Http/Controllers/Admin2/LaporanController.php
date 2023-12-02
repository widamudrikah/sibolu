<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class LaporanController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        $transactionsY = Pesanan::where("status_pesanan", "3")
            ->get()
            ->groupBy(function ($transaction) {
                return $transaction->created_at->format('Y');
            });
        return view('layouts.halaman.admin.laporan-tahun', [
            'pesanan'    => $pesanan,
            'transactionsY' => $transactionsY,
        ]);
    }

    public function showMonth($month)
    {
        // Retrieve transactions for the specified month with a specific status_bayar
        $fullDate = '2023-' . $month . '-01';

        // Retrieve transactions for the specified month and status_bayar
        $transactions = Pesanan::whereYear('created_at', substr($fullDate, 0, 4))
            ->whereMonth('created_at', substr($fullDate, 5, 2))
            ->where('status_pesanan', '3') // Add the status_bayar condition
            ->get();

        return view('layouts.halaman.admin.lap', [
            'transactions' => $transactions,
        ]);
    }


    public function showYear($year)
    {
        // Retrieve transactions for the specified year
        $transactions = Pesanan::whereYear('created_at', $year)->get();

        return view('layouts.halaman.admin.laporan-tahun-details', [
            'transactions' => $transactions,
        ]);
    }
}

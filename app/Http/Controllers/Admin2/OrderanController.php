<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class OrderanController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        return view('layouts.halaman.admin.orderan',[
            'pesanan'    => $pesanan,
        ]);
    }
}

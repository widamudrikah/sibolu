<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        // $produk = Produk::all();
        return view('layouts.halaman.masyarakat.pesananku',[
            // 'produk'    => $produk,
        ]);
    }

    public function simpanPesanan(Request $request)
    {
        return $request->all();
    }
}

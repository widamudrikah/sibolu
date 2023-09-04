<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function detailProduk($id)
    {
        $produk = Produk::find($id);
        return view('layouts.halaman.masyarakat.detail', compact('produk'));
    }
}

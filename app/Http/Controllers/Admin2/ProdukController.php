<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function tambahProduk()
    {
         return view('layouts.halaman.admin.tambah-produk');
    }

    public function dataProduk()
    {
         return view('layouts.halaman.admin.data-produk');
    }
}

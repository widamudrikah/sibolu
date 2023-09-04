<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   if(Auth::user()->role == 3){
            $produk = Produk::all();
            return view('layouts.halaman.masyarakat.home',[
                'produk'    => $produk,
            ]);
        }else{
            return view('home');
        }
    }

    public function cari(Request $request)
    {
        $searchTerm = $request->input('search');
        $produk = Produk::where('nama_produk', 'LIKE', "%{$searchTerm}%")->get();
        return view('layouts.halaman.masyarakat.home', compact('produk'));
    }
}

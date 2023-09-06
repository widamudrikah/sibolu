<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('masyarakat_id',Auth::user()->masyarakat->id)->get();
        return view('layouts.halaman.masyarakat.pesananku',[
            'pesanan'    => $pesanan,
        ]);
    }

    public function simpanPesanan(Request $request)
    {
        // return $request->all();

        if($request->kota == 0){
            $kota = "Pangkep";
        }elseif($request->kota == 50000){
            $kota = "Maros";
        }else{
            $kota = "Makassar";
        }

        $pesanan = new Pesanan();
        $pesanan->kode              = $this->generateOrderCode();
        $pesanan->masyarakat_id     = Auth::user()->masyarakat->id;
        $pesanan->produk_id         = $request->produk_id;
        $pesanan->harga             = $request->harga;
        $pesanan->jumlah            = $request->jumlah;
        $pesanan->harga_total       = $request->total;
        $pesanan->ongkir            = $request->kota;
        $pesanan->kota              = $kota;
        $pesanan->alamat            = $request->alamat;
        $pesanan->pembayaran        = $request->bayar;
        $pesanan->status_bayar      = 0;
        $pesanan->status_pesanan    = 0;
        $pesanan->save();

        $produk = Produk::find($request->produk_id);
        $produk->stok = $produk->stok - $request->jumlah;
        $produk->save();

        return redirect()->back()->with('ok',"Checkout Berhasil!");
    }

    public function generateOrderCode() {
        $latestOrder = Pesanan::latest()->first(); // Ambil pesanan terbaru dari database
        $latestNumber = 1; // Nomor urut default jika tidak ada pesanan sebelumnya

        if ($latestOrder) {
            // Jika ada pesanan sebelumnya, ambil nomor urut pesanan terbaru dan tambahkan 1
            $latestNumber = (int)substr($latestOrder->kode, 3) + 1;
        }

        // Format nomor urut dengan 3 digit angka dan gabungkan dengan prefix "SBL"
        $orderCode = 'SBL' . sprintf('%03d', $latestNumber);

        return $orderCode;
    }

}

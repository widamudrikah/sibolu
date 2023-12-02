<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Pengantar;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class OrderanController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::whereIn("status_pesanan", [0, 1, 2])->get();
        return view('layouts.halaman.admin.orderan',[
            'pesanan'    => $pesanan,
        ]);
    }

    public function histori()
    {
        $pesanan = Pesanan::where("status_pesanan", 3)->get();
        return view('layouts.halaman.admin.histori-orderan',[
            'pesanan'    => $pesanan,
        ]);
    }

    public function updateStatusOrderan (Request $request)
    {
        $orderan = Pesanan::find($request->pesanan_id);
        $orderan->status_pesanan = $request->status_pesanan;
        $orderan->status_bayar = $request->status_bayar;
        $orderan->save();

        return redirect()->back()->with('ok',"Berhasil update status!");
    }

    public function updateStatusPengantar (Request $request)
    {
        $pengantar = Pesanan::find($request->pesanan_id);
        $pengantar->pengantar_id = $request->pengantar_id;
        $pengantar->save();

        $kurir = Pengantar::find($request->pengantar_id);
        $nama = User::find($kurir->user_id);

        return redirect()->back()->with('ok',"Berhasil Memlilih $nama->nama sebagai kurir pesanan!");
    }

    public function updateStatusPesanan (Request $request)
    {
        $orderan = Pesanan::find($request->pesanan_id);
        $orderan->status_pesanan = $request->status_pesanan;
        $orderan->status_bayar = $request->status_bayar;
        $orderan->save();

        return redirect()->back()->with('ok',"Berhasil update status!");
    }

    public function updateStatusPesananKurir (Request $request)
    {
        $orderan = Pesanan::find($request->pesanan_id);
        $orderan->status_pesanan = $request->status_pesanan;
        $orderan->save();

        return redirect()->back()->with('ok',"Berhasil update status!");
    }
}

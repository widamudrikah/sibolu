<?php

namespace App\Http\Controllers\Pengantar;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\UploadImageHelper;

class PengantaranController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('pengantar_id',Auth::user()->pengantar->id)->whereIn("status_pesanan", [0, 1, 2])->get();
        return view('layouts.halaman.pengantar.pengantaran',[
            'pesanan'    => $pesanan,
        ]);
    }

    public function histori()
    {
        $pesanan = Pesanan::where('pengantar_id',Auth::user()->pengantar->id)->where("status_pesanan", 3)->get();
        return view('layouts.halaman.pengantar.histori-pengantaran',[
            'pesanan'    => $pesanan,
        ]);
    }

    public function simpanBukti(Request $request)
    {
        $pesanan = Pesanan::find($request->id_pesanan);
        $pesanan->bukti = UploadImageHelper::uploadImage($request->file('bukti'));
        $pesanan->status_bayar = 2;
        $pesanan->status_pesanan = 3;
        $pesanan->save();
        return redirect()->back()->with('ok',"Berhasil upload bukti transfer!");
    }

}

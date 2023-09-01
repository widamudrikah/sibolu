<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\RelasiMhsKel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class KelasMahasiswaController extends Controller
{
    public function index()
    {
        return view('layouts.pages.mhs.class');
    }

    public function selectClass()
    {
        $kelas = Kelas::all();
        $kelasTerdaftar = RelasiMhsKel::where('mahasiswa_id', Auth::user()->mahasiswa->id)->get();
        return view('layouts.pages.mhs.select-class',[
            'kelas'          =>$kelas,
            'kelasTerdaftar' =>$kelasTerdaftar,
        ]);
    }

    public function saveClass(Request $request)
    {
        $pilihan = new RelasiMhsKel();
        $pilihan->kelas_id      = $request->kelas_id;
        $pilihan->mahasiswa_id  = Auth::user()->mahasiswa->id;
        $pilihan->save();

        return redirect()->back()->with("ok","Mantap");
    }

    public function listMyClass()
    {
        $kelas_ku = RelasiMhsKel::where('mahasiswa_id',Auth::user()->mahasiswa->id)->get();
        return DataTables::of($kelas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('kelas_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            return $kelas->nama_kelas;
        })
        ->editColumn('mahasiswa_id', function($dt){ 
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            return $mhs->nama_mahasiswa;
        })
        ->addColumn('dosen_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            $dosen = Dosen::find($kelas->dosen_id);
            return $dosen->nama_dosen;
        })        
        ->addColumn('action', function($dt) {
            $button = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDetailBajuPelanggan_' . $dt->id . '"><i class="fa fa-eye"></i></button>';
            return $button;
        })    
        ->rawColumns(['no','kelas_id','dosen_id','action'])
        ->make(true);
    }
}

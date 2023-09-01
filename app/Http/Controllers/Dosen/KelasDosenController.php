<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\RelasiMhsKel;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class KelasDosenController extends Controller
{
    public function index()
    {
        return view('layouts.pages.dosen.class');
    }

    public function listClass()
    {
        $kelas_ku = Kelas::where('dosen_id',Auth::user()->dosen->id)->get();
        return DataTables::of($kelas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('tahun_id', function($dt){ 
            $tahun = Tahun::where('id',$dt->tahun_id)->first();
            return $tahun->tahun;
        })
        ->editColumn('dosen_id', function($dt){ 
            $dosen = Dosen::where('id',$dt->dosen_id)->first();
            return $dosen->nama_dosen;
        })
        ->addColumn('jumlah', function($dt){ 
            $jumlah = RelasiMhsKel::where('kelas_id',$dt->id)->count();
            return $jumlah;
        })
        ->addColumn('action', function($dt) {
            $urlLihatMhs = route('d.students',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlLihatMhs.'" class="btn btn-info" title="Klik untuk melihat mahasiswa">Lihat</a>';
            return $button;
        })    
        ->rawColumns(['no','tahun_id','dosen_id','jumlah','action'])
        ->make(true);
    }

    public function students($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $kelas = Kelas::find($id);
        return view('layouts.pages.dosen.mhs-by-class',[
            'kelas'     => $kelas,
            'class_id'  => $class_id,
        ]);
    }

    public function listStudents($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $studentInClass = RelasiMhsKel::where('kelas_id',$id)->get();
        return DataTables::of($studentInClass)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->addColumn('foto', function ($dt) {
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            if ($mhs->foto) {
                $foto = '<img src="' . $mhs->foto . '" alt="" class="pas-foto">';
            } else {
                $foto = '<img src="' . asset('gentella/production/images/mhs.jpg') . '" alt="" class="pas-foto">';
            }
            return $foto;
        })
        ->addColumn('nim', function($dt){ 
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            $user = User::find($mhs->user_id);
            if ($user->nim) {
                $nim = "$user->nim";
            } else {
                $nim = "-";
            }
            return $nim;
        })
        ->editColumn('mahasiswa_id', function ($dt) {
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            return ucwords(strtolower($mhs->nama_mahasiswa));
        })
        ->addColumn('action', function($dt) {
            $urlLihatMhs = route('d.students.detail',[Crypt::encrypt($dt->mahasiswa_id)]);
            $urlKeluarKelas = route('d.students.out.class',[Crypt::encrypt($dt->id)]);
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            $button = '<a href="'.$urlLihatMhs.'" class="btn btn-info" title="Lihat detail '.ucwords(strtolower($mhs->nama_mahasiswa)).'"><i class="fa fa-eye"></i></a>';
            $button .= '<a href="'.$urlKeluarKelas.'" onclick="return confirm(\'Apakah Anda yakin ingin mengeluarkan '.ucwords(strtolower($mhs->nama_mahasiswa)).' dari kelas?\')" class="btn btn-danger" title="Keluarkan '.ucwords(strtolower($mhs->nama_mahasiswa)).' dari kelas"><i class="fa fa-sign-out"></i></a>';
            return $button;
        })    
        ->rawColumns(['no','foto','nim','mahasiswa_id','action'])
        ->make(true);
    }

    public function outClass($relation_id)
    {
        $id = Crypt::decrypt($relation_id);
        $studentInClass = RelasiMhsKel::find($id);
        $studentInClass->delete();
        return redirect()->back()->with("ok","Berhasil menggeluarkan mahasiswa");
    }
}

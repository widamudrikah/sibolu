<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Helpers\ModalDosenHelper;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\RelasiMhsKel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class MateriController extends Controller
{
    public function materialByClass()
    {
        return view('layouts.pages.mhs.materi.materi');
    }

    public function listMaterialByClass()
    {
        $kelas_ku = RelasiMhsKel::where('mahasiswa_id',Auth::user()->mahasiswa->id)->get();
        return DataTables::of($kelas_ku)
        ->addColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('kelas_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            return $kelas->nama_kelas;
        })
        ->addColumn('materi', function($dt){ 
            $jumlah = Materi::where('kelas_id',$dt->id)->count();
            $formattedJumlah = $jumlah == 0 ? '0' : str_pad($jumlah, 2, '0', STR_PAD_LEFT);
            return $formattedJumlah;
        })
        ->addColumn('action', function($dt) {
            $urlMateri = route('m.material.view',[Crypt::encrypt($dt->kelas_id)]);
            $button = '<a href="'.$urlMateri.'" class="btn btn-info">Lihat Materi</a>';
            return $button;
        })    
        ->rawColumns(['no','kelas_id','materi','action'])
        ->make(true);
    }

    public function viewMaterials($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $kelas = Kelas::find($id);
        return view('layouts.pages.mhs.materi.materi-kelas',[
            'kelas'     => $kelas,
            'class_id'  => $class_id,
        ]);
    }

    public function listMaterials($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $materi = Materi::where('kelas_id',$id)->get();
        return DataTables::of($materi)
        ->addColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('tgl_materi', function($dt){ 
            $dateString = $dt->tgl_materi;
            $timestamp = strtotime($dateString);
            $tgl_dead = date("d-m-Y", $timestamp);
            return $tgl_dead;
        })
        ->editColumn('nama_materi', function($dt){ 
            $button = '<a href="#" data-toggle="modal" data-target="#lihatMateri' . $dt->id . '">Lihat Materi</a>';
            return $button . ModalDosenHelper::lihatMateri($dt); 
        })
        ->editColumn('rincian_materi', function($dt){          
            $button = '<a href="#" data-toggle="modal" data-target="#lihatDeskripsiMateri' . $dt->id . '">Lihat Deskripsi</a>';
            return $button . ModalDosenHelper::lihatDeskripsiMateri($dt); 
        })
        ->addColumn('action', function($dt) {
            $urlEditMateri = route('m.material.detail',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlEditMateri.'" class="btn btn-info" title="Klik untuk edit informasi materi"><i class="fa fa-eye"></i></a>';
            return $button;
        })    
        ->rawColumns(['no','tgl_materi','nama_materi','rincian_materi','action'])
        ->make(true);
    }

    public function detailMaterial($material_id)
    {
        $id = Crypt::decrypt($material_id);
        $materi = Materi::find($id);
        $kelas = Kelas::find($materi->kelas_id);
        return view('layouts.pages.mhs.materi.detail-material',[
            'materi'         => $materi,
            'kelas'          => $kelas,
        ]);
    }
}

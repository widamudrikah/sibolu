<?php

namespace App\Http\Controllers\Dosen;

use App\Helpers\ModalDosenHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MateriDosenRequest;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class MateriDosenController extends Controller
{
    public function materialAdd()
    {
        $kelas = Kelas::where('dosen_id',Auth::user()->dosen->id)->get();
        return view('layouts.pages.dosen.add-material',[
            'kelas' => $kelas,
        ]);
    }

    public function saveMaterial(MateriDosenRequest $request)
    {
        $materi  = new Materi();
        $materi->dosen_id        = Auth::user()->dosen->id;
        $materi->kelas_id        = $request->kelas_id;
        $materi->tgl_materi      = $request->tgl_materi;
        $materi->nama_materi     = $request->nama_materi;
        $materi->rincian_materi  = $request->rincian_materi;
        $materi->save();
        return redirect()->route('d.material.view',[Crypt::encrypt($request->kelas_id)])->with('okk',"Berhasil menambah materi");

    }

    public function editMaterial($material_id)
    {
        $id = Crypt::decrypt($material_id);
        $materi = Materi::find($id);
        $kelas = Kelas::find($materi->kelas_id);
        $selectClass = Kelas::where('dosen_id',Auth::user()->dosen->id)->get();
        return view('layouts.pages.dosen.materi.edit-material',[
            'materi'         => $materi,
            'kelas'          => $kelas,
            'selectClass'    => $selectClass,
        ]);
    }

    public function saveChangeMaterial(MateriDosenRequest $request)
    {
        $id = Crypt::decrypt($request->material_id);
        $materi = Materi::find($id);
        $materi->kelas_id        = $request->kelas_id;
        $materi->tgl_materi      = $request->tgl_materi;
        $materi->nama_materi     = $request->nama_materi;
        $materi->rincian_materi  = $request->rincian_materi;
        $materi->save();

        return redirect()->route('d.material.view',Crypt::encrypt($request->kelas_id))->with('ok2',"Berhasil membuat pembaruan tugas");
    }

    public function materialByClass()
    {
        return view('layouts.pages.dosen.materi.materi');
    }

    public function listMaterialByClass()
    {
        $kelas_ku = Kelas::where('dosen_id',Auth::user()->dosen->id)->get();
        return DataTables::of($kelas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('materi', function($dt){ 
            $dosen = Dosen::where('id',$dt->dosen_id)->first();
            $jumlah = Materi::where('dosen_id',$dosen->id)->where('kelas_id',$dt->id)->count();
            $formattedJumlah = $jumlah == 0 ? '0' : str_pad($jumlah, 2, '0', STR_PAD_LEFT);
            return $formattedJumlah;
        })
        ->addColumn('action', function($dt) {
            $urlMateri = route('d.material.view',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlMateri.'" class="btn btn-info">Lihat Materi</a>';
            return $button;
        })    
        ->rawColumns(['no','materi','action'])
        ->make(true);
    }

    public function viewMaterials($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $kelas = Kelas::find($id);
        return view('layouts.pages.dosen.materi.materi-kelas',[
            'kelas'     => $kelas,
            'class_id'  => $class_id,
        ]);
    }

    public function listMaterials($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $materi = Materi::where('dosen_id',Auth::user()->dosen->id)->where('kelas_id',$id)->get();
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
            $urlHapus = route('d.material.delete',[Crypt::encrypt($dt->id)]);
            $urlEditMateri = route('d.material.edit',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlEditMateri.'" class="btn btn-info" title="Klik untuk edit informasi materi"><i class="fa fa-edit"></i></a>';
            $button .= '<a href="'.$urlHapus.'" onclick="return confirm(\'Apakah Anda yakin ingin menghapus materi ini?\')" class="btn btn-danger" title="Klik untuk Menghapus"><i class="fa fa-trash-o"></i></a>';  
            return $button;
        })    
        ->rawColumns(['no','tgl_materi','nama_materi','rincian_materi','action'])
        ->make(true);
    }

    public function delMaterial($material_id)
    {
        $id = Crypt::decrypt($material_id);
        $materi = Materi::find($id);   
        $materi->delete();
        return redirect()->back()->with("hapus","Berhasil hapus data materi");    
    }
}

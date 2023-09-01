<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalAdminHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\RelasiMhsKel;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.class');
    }

    public function addClass()
    {
        $tahun = Tahun::all();
        $dosen = Dosen::all();
        return view('layouts.pages.admin.add-class',[
            'tahun' => $tahun,
            'dosen' => $dosen,
        ]);
    }

    public function saveClass(KelasRequest $request)
    {

        $kelas = new Kelas();
        $kelas->nama_kelas  = $request->nama_kelas;
        $kelas->tahun_id    = $request->tahun_id;
        $kelas->dosen_id    = $request->dosen_id;
        $kelas->save();

        return redirect()->back()->with('ok',"Sukses menyimpan data kelas");
    }

    public function saveChangeClass(Request $request)
    {
        $id = Crypt::decrypt($request->class_id);
        $kelas = Kelas::find($id);
        $kelas->nama_kelas  = $request->nama_kelas;
        $kelas->tahun_id    = $request->tahun_id;
        $kelas->dosen_id    = $request->dosen_id;
        $kelas->save();
        
        return redirect()->back()->with('sukses',"Sukses menyimpan data jurusan");
    }

    public function listClass()
    {
        $kelas = Kelas::all();
        return DataTables::of($kelas)
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
        ->editColumn('mahasiswa', function($dt){ 
            $jumlah = RelasiMhsKel::where('kelas_id',$dt->id)->count();
            $formattedJumlah = $jumlah == 0 ? '0' : str_pad($jumlah, 2, '0', STR_PAD_LEFT);
            return $formattedJumlah;
        })
        ->addColumn('action', function($dt) {
            $button = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEditKelas' . $dt->id . '"><i class="fa fa-pencil"></i></button>';
            return $button . ModalAdminHelper::modalEditKelas($dt);
        })    
        ->rawColumns(['no','tahun_id','dosen_id','mahasiswa','action'])
        ->make(true);
    }
}

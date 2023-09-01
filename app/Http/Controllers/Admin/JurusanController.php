<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalAdminHelper;
use App\Helpers\ModalDosenHelper;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class JurusanController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.major');
    }

    public function addMajor()
    {
        return view('layouts.pages.admin.add-major');
    }

    public function saveMajor(Request $request)
    {
        $major = new Jurusan();
        $major->nama_jurusan = $request->nama_jurusan;
        $major->save();
        return redirect()->back()->with('ok',"Sukses menyimpan data jurusan");
    }

    public function saveChangeMajor(Request $request)
    {
        $id = Crypt::decrypt($request->major_id);
        $major = Jurusan::find($id);
        $major->nama_jurusan = $request->nama_jurusan;
        $major->save();
        return redirect()->back()->with('sukses',"Sukses menyimpan data jurusan");
    }

    public function listMajor()
    {
        $jurusan = Jurusan::all();
        return DataTables::of($jurusan)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->addColumn('action', function($dt) {
            $button = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEditJurusan' . $dt->id . '"><i class="fa fa-pencil"></i></button>';
            return $button . ModalAdminHelper::modalEditJurusan($dt);
        })    
        ->rawColumns(['no','nama_jurusan','action'])
        ->make(true);
    }
}

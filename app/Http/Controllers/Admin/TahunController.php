<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalAdminHelper;
use App\Http\Controllers\Controller;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class TahunController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.year');
    }

    public function addYear()
    {
        return view('layouts.pages.admin.add-year');
    }

    public function saveYear(Request $request)
    {
        $year = new Tahun();
        $year->tahun = $request->tahun;
        $year->save();
        return redirect()->back()->with('ok',"Sukses menyimpan tahun perkuliahan");
    }

    public function saveChangeYear(Request $request)
    {
        $id = Crypt::decrypt($request->year_id);
        $year = Tahun::find($id);
        $year->tahun = $request->tahun;
        $year->save();
        
        return redirect()->back()->with('sukses',"Sukses menyimpan data tahun");
    }

    public function listYear()
    {
        $pesanan = Tahun::all();
        return DataTables::of($pesanan)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->addColumn('action', function($dt) {
            $button = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEditYear' . $dt->id . '"><i class="fa fa-pencil"></i></button>';
            return $button . ModalAdminHelper::modalEditYear($dt);
        })    
        ->rawColumns(['no','tahun','action'])
        ->make(true);
    }
}

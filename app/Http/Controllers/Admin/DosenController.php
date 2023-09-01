<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class DosenController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.lecturer');
    }

    public function addLecturer()
    {
        return view('layouts.pages.admin.add-lecturer');
    }

    public function saveLecturer(DosenRequest $request)
    {
        if ($request->hasFile('foto')) {
            $user   = new User();
            $user->nidn     = $request->nidn;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->role     = 2;
            $user->save();

            $dosen  = new Dosen();
            $dosen->user_id         = $user->id;
            $dosen->nama_dosen      = $request->nama_dosen;
            $dosen->tempat_lahir    = $request->tempat_lahir;
            $dosen->tgl_lahir       = $request->tanggal_lahir;
            $dosen->gender          = $request->gender;
            $dosen->foto            = UploadImageHelper::uploadImage($request->file('foto'));
            $dosen->save();
        }else{
            $user   = new User();
            $user->nidn     = $request->nidn;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->role     = 2;
            $user->save();

            $dosen  = new Dosen();
            $dosen->user_id         = $user->id;
            $dosen->nama_dosen      = $request->nama_dosen;
            $dosen->tempat_lahir    = $request->tempat_lahir;
            $dosen->tgl_lahir       = $request->tanggal_lahir;
            $dosen->gender          = $request->gender;
            $dosen->save();
        }

        return redirect()->back()->with('ok',"Sukses menyimpan data dosen");

    }

    public function listLecturer()
    {
        $dosen = Dosen::all();
        return DataTables::of($dosen)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->addColumn('email', function($dt){ 
            $user = User::where('id',$dt->user_id)->first();
            return $user->email;
        })
        ->editColumn('nidn', function($dt){ 
            $user = User::where('id',$dt->user_id)->first();
            if($user->nidn){
                $nidn = strtoupper($user->nidn);
            }else{
                $nidn = "-";
            }
            return $nidn;
        })
        ->addColumn('action', function($dt) {
            $urlReset = route('a.reset.password',[Crypt::encrypt($dt->user_id)]);
            $button = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDetailBajuPelanggan_' . $dt->id . '"><i class="fa fa-pencil"></i></button>';
            $button .= '<a href="'.$urlReset.'" class="btn btn-warning" onclick="return confirm(\'Akun User '.ucwords(strtolower($dt->nama_dosen)).' akan direset?\')" title="Reset Password '.ucwords(strtolower($dt->nama_dosen)).'"><i class="fa fa-unlock-alt"></i></a>';
            return $button;
        })    
        ->rawColumns(['no','email','nidn','action'])
        ->make(true);
    }
}

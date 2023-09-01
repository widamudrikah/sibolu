<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Helpers\UploadImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $mhs = Mahasiswa::find(Auth::user()->mahasiswa->id);
        $jurusan = Jurusan::find($mhs->jurusan_id);
        $user = User::find($mhs->user_id);
        if ($user->nim) {
            $nim = "$user->nim";
        } else {
            $nim = "-";
        }
        return view('layouts.pages.mhs.my-profile',[
            'mhs'     => $mhs,
            'jurusan' => $jurusan,
            'nim'     => $nim,
        ]);
    }

    public function saveMyProfile(ProfileRequest $request)
    {
        // dd($request->all());
        $mhs = Mahasiswa::find(Auth::user()->mahasiswa->id);
        $mhs->tempat_lahir  = $request->tempat_lahir;
        $mhs->tgl_lahir     = $request->tgl_lahir;
        $mhs->telp          = $request->telp;
        $mhs->alasan        = $request->alasan;
        $mhs->foto          = UploadImageHelper::uploadImage($request->file('foto'));
        $mhs->lengkap       = 1;
        $mhs->save();        
        return redirect()->route('m.home')->with("welcome","Halo");
    }
}

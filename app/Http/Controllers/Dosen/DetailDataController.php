<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DetailDataController extends Controller
{
    public function detailStudents($student_id)
    {
        $id = Crypt::decrypt($student_id);
        $mhs = Mahasiswa::find($id);
        $jurusan = Jurusan::find($mhs->jurusan_id);
        $user = User::find($mhs->user_id);
        if ($user->nim) {
            $nim = "$user->nim";
        } else {
            $nim = "-";
        }
        return view('layouts.pages.dosen.detail-mhs',[
            'mhs'     => $mhs,
            'jurusan' => $jurusan,
            'nim'     => $nim,
        ]);
    }
}

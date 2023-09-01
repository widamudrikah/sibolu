<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.student');
    }

    public function addStudent()
    {
        $jurusan = Jurusan::all();
        return view('layouts.pages.admin.add-student',[
            'jurusan'   => $jurusan,
        ]);
    }

    public function saveStudent(MahasiswaRequest $request)
    {
        if ($request->hasFile('foto')) {
            $user   = new User();
            $user->nim      = $request->nim;
            $user->email    = $request->email;
            if($request->password){
                $user->password = Hash::make($request->password);
            }else{
                $user->password = Hash::make("idn12345");
            }
            $user->role     = 3;
            $user->save();

            $mhs  = new Mahasiswa();
            $mhs->user_id         = $user->id;
            $mhs->jurusan_id      = $request->jurusan_id;
            $mhs->nama_mahasiswa  = $request->nama_mahasiswa;
            $mhs->tempat_lahir    = $request->tempat_lahir;
            $mhs->tgl_lahir       = $request->tanggal_lahir;
            $mhs->gender          = $request->gender;
            $mhs->foto            = UploadImageHelper::uploadImage($request->file('foto'));
            $mhs->save();
        }else{
            $user   = new User();
            $user->nim      = $request->nim;
            $user->email    = $request->email;
            if($request->password){
                $user->password = Hash::make($request->password);
            }else{
                $user->password = Hash::make("idn12345");
            }
            $user->role     = 3;
            $user->save();

            $mhs  = new Mahasiswa();
            $mhs->user_id         = $user->id;
            $mhs->jurusan_id      = $request->jurusan_id;
            $mhs->nama_mahasiswa  = $request->nama_mahasiswa;
            $mhs->tempat_lahir    = $request->tempat_lahir;
            $mhs->tgl_lahir       = $request->tanggal_lahir;
            $mhs->gender          = $request->gender;
            $mhs->save();
        }

        return redirect()->back()->with('ok',"Sukses menyimpan data mahasiswa");

    }

    public function listStudent()
    {
        $mahasiswa = Mahasiswa::all();
        return DataTables::of($mahasiswa)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('jurusan_id', function($dt){ 
            $jurusan = Jurusan::find($dt->jurusan_id);
            return strtoupper($jurusan->nama_jurusan);
        })
        ->editColumn('nim', function($dt){ 
            $user = User::find($dt->user_id);
            if($user->nim){
                $nim = strtoupper($user->nim);
            }else{
                $nim = "-";
            }
            return $nim;
        })
        ->editColumn('nama_mahasiswa', function($dt){ 
            return strtoupper($dt->nama_mahasiswa);
        })
        ->addColumn('action', function($dt) {
            $urlLihatMhs = route('a.students.detail',[Crypt::encrypt($dt->id)]);
            $urlReset = route('a.reset.password',[Crypt::encrypt($dt->user_id)]);
            $button = '<a href="'.$urlLihatMhs.'" class="btn btn-info" title="Lihat detail dan edit data '.ucwords(strtolower($dt->nama_mahasiswa)).'"><i class="fa fa-pencil"></i></a>';
            $button .= '<a href="'.$urlReset.'" class="btn btn-warning" onclick="return confirm(\'Akun User '.ucwords(strtolower($dt->nama_mahasiswa)).' akan direset?\')" title="Reset Password '.ucwords(strtolower($dt->nama_mahasiswa)).'"><i class="fa fa-unlock-alt"></i></a>';
            return $button;
        })    
        ->rawColumns(['no','jurusan_id','nim','nama_mahasiswa','action'])
        ->make(true);
    }

    public function detailStudents($student_id)
    {
        $id = Crypt::decrypt($student_id);
        $mhs = Mahasiswa::find($id);
        $jurusan = Jurusan::all();
        $user = User::find($mhs->user_id);
        if ($user->nim) {
            $nim = "$user->nim";
        } else {
            $nim = "-";
        }
        return view('layouts.pages.admin.detail-mhs',[
            'mhs'     => $mhs,
            'user'     => $user,
            'jurusan' => $jurusan,
            'nim'     => $nim,
        ]);
    }

    public function saveChangeStudent(Request $request)
    {
        // dd($request->all());
        $id = Crypt::decrypt($request->student_id);
        $mhs = Mahasiswa::find($id);
        $user = User::find($mhs->user_id);
        $user->nim              = $request->nim;
        $user->email            = $request->email;
        $mhs->nama_mahasiswa    = $request->nama_mahasiswa;
        $mhs->tempat_lahir      = $request->tempat_lahir;
        $mhs->tgl_lahir         = $request->tgl_lahir;
        $mhs->gender            = $request->gender;
        $mhs->telp              = $request->telp;
        $mhs->jurusan_id        = $request->jurusan_id;
        $mhs->alasan            = $request->alasan;
        $mhs->lengkap           = $request->lengkap;
        if ($request->hasFile('foto')) {
            $mhs->foto              = UploadImageHelper::uploadImage($request->file('foto'));
        }
        $mhs->save();        
        $user->save();        
        return redirect()->route('a.student')->with("sukses","Halo");
    }

    public function resetPasswordUser($user_id)
    {
        $id = Crypt::decrypt($user_id);
        $user = User::find($id);
        $user->password = Hash::make("idn12345");
        $user->save();

        if($user->role == 2){
            return redirect()->route('a.lecturer')->with("reset","Sukses Reset");
        }else{
            return redirect()->route('a.student')->with("reset","Sukses Reset");
        }
    }
}

<?php

namespace App\Http\Controllers\Dosen;

use App\Helpers\ModalDosenHelper;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\HasilTugas;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class ResponTugasController extends Controller
{
    public function responseTask($task_id)
    {
        $id = Crypt::decrypt($task_id);
        $tugas = Tugas::find($id);    
        $kelas = Kelas::find($tugas->kelas_id);
        $dosen = Dosen::find($tugas->dosen_id);
        return view('layouts.pages.dosen.response.index',[
            'tugas'     => $tugas,
            'task_id'   => $task_id,
            'kelas'   => $kelas,
            'dosen'   => $dosen,
        ]);
    }

    public function listResponseTask($task_id)
    {
        $id = Crypt::decrypt($task_id);
        $hasilTugas = HasilTugas::where('tugas_id',$id)->get();
        return DataTables::of($hasilTugas)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('mengirim', function($dt){ 
            $tgl = Carbon::parse($dt->created_at)->format('d-m-Y');
            $jam = Carbon::parse($dt->created_at)->format('H:i:s');
            $waktu = "$tgl<br>$jam";
            return $waktu;
        })
        ->editColumn('mahasiswa_id', function($dt){ 
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            return $mhs->nama_mahasiswa;
        })
        ->editColumn('link_tugas', function($dt){          
            $button = '<a href="'.$dt->link_tugas.'" target="_blank" class="link-tugas">Lihat Link</a>';
            return $button; 
        })
        ->editColumn('kendala', function($dt){          
            $button = '<a href="#" data-toggle="modal" data-target="#lihatKendala' . $dt->id . '">Lihat Kendala</a>';
            return $button . ModalDosenHelper::lihatKendala($dt); 
        })
        ->editColumn('komentar', function($dt){ 
            if($dt->komentar){
                $komentar = '<a href="#" data-toggle="modal" data-target="#lihatPesan' . $dt->id . '">Lihat Pesan</a>';
                $komentar .= ModalDosenHelper::lihatPesan($dt); 
            }else{
                $komentar = "-";
            }
            return $komentar; 
        })
        ->editColumn('nilai', function($dt){ 
            if($dt->nilai){
                $nilai = "$dt->nilai";
            }else{
                $nilai = "-";
            }
            return $nilai;
        })
        ->addColumn('action', function($dt) {
            $urlDelete = route('d.response.delete',[Crypt::encrypt($dt->id)]);
            $button = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#pesandannilai' . $dt->id . '"><i class="fa fa-edit"></i></button>';
            $button .= '<a href="' . $urlDelete . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>'; 
            return $button . ModalDosenHelper::pesanDanNilai($dt);
        })    
        ->rawColumns(['no','mengirim','mahasiswa_id','link_tugas','kendala','komentar','nilai','action'])
        ->make(true);
    }

    public function delResponseTask($result_id)
    {
        $id = Crypt::decrypt($result_id);
        $hasilTugas = HasilTugas::find($id);   
        $hasilTugas->delete();
        return redirect()->back()->with("on","Berhasil hapus data tugas");  
        // return redirect()->route('d.response',[Crypt::encrypt($hasilTugas->tugas_id)])->with("on","Berhasil hapus data tugas");  
    }

    public function feedBack(Request $request)
    {
        $id = Crypt::decrypt($request->hasil_tugas_id);
        $hasil = HasilTugas::find($id);     
        $hasil->nilai = $request->nilai;
        $hasil->komentar = $request->komentar;
        $hasil->save();
        return redirect()->back()->with("gas","Berhasil update tugas"); 
    }
}

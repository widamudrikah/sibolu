<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Helpers\ModalDosenHelper;
use App\Helpers\ModalMhsHelper;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\HasilTugas;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\RelasiMhsKel;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class TugasMahasiswaController extends Controller
{
    public function index()
    {
        return view('layouts.pages.mhs.task');
    }

    public function taskSent()
    {
        return view('layouts.pages.mhs.task-sent');
    }

    public function listMyTask()
    {
        $kelas_ku = RelasiMhsKel::where('mahasiswa_id',Auth::user()->mahasiswa->id)->get();
        return DataTables::of($kelas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('kelas_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            return $kelas->nama_kelas;
        })
        ->editColumn('mahasiswa_id', function($dt){ 
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            return $mhs->nama_mahasiswa;
        })
        ->addColumn('dosen_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            $dosen = Dosen::find($kelas->dosen_id);
            return $dosen->nama_dosen;
        })        
        ->addColumn('jumlah_tugas', function($dt){ 
            $sumtugas = Tugas::where('kelas_id',$dt->kelas_id)->where('status', 1)->count();
            return $sumtugas;
        })        
        ->addColumn('action', function($dt) {
            $urlTugasPerKelas = route('m.task.2',[Crypt::encrypt($dt->kelas_id)]);
            $button = '<a href="'.$urlTugasPerKelas.'" class="btn btn-info">Lihat Tugas</a>';
            return $button;
        })    
        ->rawColumns(['no','kelas_id','dosen_id','jumlah_tugas','action'])
        ->make(true);
    }

    public function listMyTaskSent()
    {
        $kelas_ku = RelasiMhsKel::where('mahasiswa_id',Auth::user()->mahasiswa->id)->get();
        return DataTables::of($kelas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('kelas_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            return $kelas->nama_kelas;
        })
        ->editColumn('mahasiswa_id', function($dt){ 
            $mhs = Mahasiswa::find($dt->mahasiswa_id);
            return $mhs->nama_mahasiswa;
        })
        ->addColumn('dosen_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            $dosen = Dosen::find($kelas->dosen_id);
            return $dosen->nama_dosen;
        })        
        ->addColumn('jumlah_tugas', function($dt){ 
            $sumtugas = HasilTugas::where('kelas_id',$dt->kelas_id)->where('mahasiswa_id', $dt->mahasiswa_id)->count();
            return $sumtugas;
        })        
        ->addColumn('action', function($dt) {
            $urlTugasTerkirimPerKelas = route('m.task.sent.view',[Crypt::encrypt($dt->kelas_id)]);
            $button = '<a href="'.$urlTugasTerkirimPerKelas.'" class="btn btn-info">Lihat</a>';
            return $button;
        })    
        ->rawColumns(['no','kelas_id','dosen_id','jumlah_tugas','action'])
        ->make(true);
    }

    public function index2($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $kelas = Kelas::find($id);
        return view('layouts.pages.mhs.list-my-task',[
            'class_id'    => $class_id,
            'kelas'    => $kelas,
        ]);
    }

    public function taskSentAtClass($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $kelas = Kelas::find($id);
        return view('layouts.pages.mhs.list-task-sent',[
            'class_id'    => $class_id,
            'kelas'       => $kelas,
        ]);
    }

    public function listMyTaskClass($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $tugas_ku = Tugas::where('kelas_id',$id)->where('status', 1)->get();
        return DataTables::of($tugas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('kelas_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            return $kelas->nama_kelas;
        })
        ->editColumn('tugas_ke', function($dt){              
            $tugas_ke = "Tugas-$dt->tugas_ke";
            return $tugas_ke;
        })
        ->editColumn('jenis', function($dt){ 
            if($dt->jenis_tugas == 1){
                $jenis = "YouTube";
            }else{
                $jenis = "Blog, Artikel atau Lainnya";
            }
            return $jenis;
        })
        ->editColumn('soal', function($dt){ 
            $button = '<a href="#" data-toggle="modal" data-target="#lihatSoal' . $dt->id . '">Lihat Soal</a>';
            return $button . ModalDosenHelper::lihatSoal($dt); 
        })
        ->editColumn('deskripsi', function($dt){          
            $button = '<a href="#" data-toggle="modal" data-target="#lihatDeskripsi' . $dt->id . '">Lihat Deskripsi</a>';
            return $button . ModalDosenHelper::lihatDeskripsi($dt); 
        })
        ->editColumn('tgl_deadline', function($dt){ 
            $deadline = "$dt->tgl_deadline<br>($dt->jam_deadline)";
            return $deadline;
        })
        ->editColumn('status', function($dt){ 
            if($dt->status == 1){
                $status = "Aktif";
            }else{
                $status = "Nonaktif";
            }
            return $status;
        })        
        ->addColumn('action', function($dt) {
            $urlSendTask = route('m.task.send',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlSendTask.'" class="btn btn-info"><i class="fa fa-send-o"></i></a>';
            return $button;
        })    
        ->rawColumns(['no','kelas_id','soal','jenis','deskripsi','tugas_ke','tgl_deadline','status','action'])
        ->make(true);
    }

    public function listMyTaskSentClass($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $tugas_ku = HasilTugas::where('kelas_id',$id)->where('mahasiswa_id', Auth::user()->mahasiswa->id)->get();
        return DataTables::of($tugas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('tugas_ke', function($dt){ 
            $task = Tugas::find($dt->tugas_id);
            return "Tugas-$task->tugas_ke";
        })
        ->addColumn('jenis_tugas', function($dt){ 
            $task = Tugas::find($dt->tugas_id);
            if($task->jenis_tugas == 1){
                $jenis = "YouTube";
            }else{
                $jenis = "Blog, Artikel atau Lainnya";
            }
            return $jenis;
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
        ->addColumn('action', function($dt) {
            if($dt->nilai){
                $button = '<button disabled class="btn btn-info" data-toggle="modal" data-target="#editTugas' . $dt->id . '"><i class="fa fa-edit"></i> Edit</button>';
            }else{
                $button = '<button class="btn btn-info" data-toggle="modal" data-target="#editTugas' . $dt->id . '"><i class="fa fa-edit"></i> Edit</button>';
            }
            return $button . ModalMhsHelper::editTugasTerkirim($dt);
        })    
        ->rawColumns(['no','tugas_ke','jenis_tugas','link_tugas','kendala','komentar','action'])
        ->make(true);
    }
}

<?php

namespace App\Http\Controllers\Dosen;

use App\Helpers\ModalDosenHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TugasDosenRequest;
use App\Models\Dosen;
use App\Models\HasilTugas;
use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class TugasDosenController extends Controller
{
    public function index()
    {
        return view('layouts.pages.dosen.task');
    }

    public function taskByClass()
    {
        return view('layouts.pages.dosen.tugas.task-by-class');
    }

    public function taskRespon($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $kelas = Kelas::find($id);
        return view('layouts.pages.dosen.tugas.task-respon',[
            'kelas'     => $kelas,
            'class_id'  => $class_id,
        ]);
    }

    public function addTask()
    {
        $kelas = Kelas::where('dosen_id',Auth::user()->dosen->id)->get();
        return view('layouts.pages.dosen.add-task',[
            'kelas' => $kelas,
        ]);
    }

    public function editTask($task_id)
    {
        $id = Crypt::decrypt($task_id);
        $tugas = Tugas::find($id);
        $kelas = Kelas::find($tugas->kelas_id);
        $selectClass = Kelas::where('dosen_id',Auth::user()->dosen->id)->get();
        return view('layouts.pages.dosen.edit-task',[
            'tugas'         => $tugas,
            'kelas'         => $kelas,
            'selectClass'   => $selectClass,
        ]);
    }

    public function saveChangeTask(Request $request)
    {
        $id = Crypt::decrypt($request->task_id);
        $tugas = Tugas::find($id);
        $tugas->kelas_id        = $request->kelas_id;
        $tugas->jenis_tugas     = $request->jenis_tugas;
        $tugas->tugas_ke        = $request->tugas_ke;
        $tugas->tgl_deadline    = $request->deadline;
        $tugas->jam_deadline    = $request->jam;
        $tugas->soal            = $request->soal;
        $tugas->deskripsi       = $request->deskripsi;
        $tugas->save();

        return redirect()->route('d.task.respon',Crypt::encrypt($request->kelas_id))->with('ok',"Berhasil membuat pembaruan tugas");
    }

    public function saveTask(TugasDosenRequest $request)
    {
        $tugas  = new Tugas();
        $tugas->dosen_id        = Auth::user()->dosen->id;
        $tugas->kelas_id        = $request->kelas_id;
        $tugas->jenis_tugas     = $request->jenis_tugas;
        $tugas->tugas_ke        = $request->tugas_ke;
        $tugas->tgl_deadline    = $request->deadline;
        $tugas->jam_deadline    = $request->jam;
        $tugas->soal            = $request->soal;
        $tugas->deskripsi       = $request->deskripsi;
        $tugas->status          = 1;
        $tugas->save();

        return redirect()->back()->with('ok',"Berhasil mengirim tugas");

    }

    public function listTask()
    {
        $tugas = Tugas::where('dosen_id',Auth::user()->dosen->id)->get();
        return DataTables::of($tugas)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('kelas_id', function($dt){ 
            $kelas = Kelas::find($dt->kelas_id);
            return $kelas->nama_kelas;
        })
        ->editColumn('tugas_ke', function($dt){ 
            if($dt->jenis_tugas == 1){
                $jenis = "YouTube";
            }else{
                $jenis = "Blog, Artikel atau Lainnya";
            }
            $tugas_ke = "Tugas-$dt->tugas_ke<br>($jenis)";
            return $tugas_ke;
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
            $dateString = $dt->tgl_deadline;
            $timestamp = strtotime($dateString);
            $tgl_dead = date("d-m-Y", $timestamp);
            $deadline = "$tgl_dead<br>($dt->jam_deadline)";
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
            $urlStatusAktif = route('d.task.status',[Crypt::encrypt($dt->id),1]);
            $urlStatusNonaktif = route('d.task.status',[Crypt::encrypt($dt->id),2]);
            $urlResponse = route('d.response',[Crypt::encrypt($dt->id)]);
            $urlEditTugas = route('d.task.edit',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlResponse.'" class="btn btn-info" title="Klik untuk melihat respon tugas"><i class="fa fa-eye"></i></a>';
            $button .= '<a href="'.$urlEditTugas.'" class="btn btn-warning" title="Klik untuk edit informasi tugas"><i class="fa fa-edit"></i></a>';
            if($dt->status == 1){
                $button .= '<a href="'.$urlStatusNonaktif.'" class="btn btn-success" title="Klik untuk Nonaktif">A</a>';
            }else{
                $button .= '<a href="'.$urlStatusAktif.'" class="btn btn-danger" title="Klik untuk Aktifkan">N</a>';
            }   
            return $button;
        })    
        ->rawColumns(['no','kelas_id','tugas_ke','soal','deskripsi','tgl_deadline','status','action'])
        ->make(true);
    }

    public function listResponClass($class_id)
    {
        $id = Crypt::decrypt($class_id);
        $tugas = Tugas::where('dosen_id',Auth::user()->dosen->id)->where('kelas_id',$id)->get();
        return DataTables::of($tugas)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('tugas_ke', function($dt){ 
            return "Tugas-$dt->tugas_ke";
        })
        ->editColumn('jenis', function($dt){ 
            if($dt->jenis_tugas == 1){
                $jenis = "YouTube";
            }else{
                $jenis = "Blog, Artikel atau Lainnya";
            }
            $tugas_ke = "Tugas-$dt->tugas_ke<br>($jenis)";
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
            $dateString = $dt->tgl_deadline;
            $timestamp = strtotime($dateString);
            $tgl_dead = date("d-m-Y", $timestamp);
            $deadline = "$tgl_dead<br>($dt->jam_deadline)";
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
            $urlStatusAktif = route('d.task.status',[Crypt::encrypt($dt->id),1]);
            $urlStatusNonaktif = route('d.task.status',[Crypt::encrypt($dt->id),2]);
            $urlResponse = route('d.response',[Crypt::encrypt($dt->id)]);
            $urlEditTugas = route('d.task.edit',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlResponse.'" class="btn btn-info" title="Klik untuk melihat respon tugas"><i class="fa fa-eye"></i></a>';
            $button .= '<a href="'.$urlEditTugas.'" class="btn btn-warning" title="Klik untuk edit informasi tugas"><i class="fa fa-edit"></i></a>';
            if($dt->status == 1){
                $button .= '<a href="'.$urlStatusNonaktif.'" class="btn btn-success" title="Klik untuk Nonaktif">A</a>';
            }else{
                $button .= '<a href="'.$urlStatusAktif.'" class="btn btn-danger" title="Klik untuk Aktifkan">N</a>';
            }   
            return $button;
        })    
        ->rawColumns(['no','tugas_ke','jenis','soal','deskripsi','tgl_deadline','status','action'])
        ->make(true);
    }

    public function listTaskByClass()
    {
        $kelas_ku = Kelas::where('dosen_id',Auth::user()->dosen->id)->get();
        return DataTables::of($kelas_ku)
        ->editColumn('no', function($dt){ 
            static $counter = 0;
            return ++$counter;
        })
        ->editColumn('jumlah_tugas', function($dt){ 
            $dosen = Dosen::where('id',$dt->dosen_id)->first();
            $jumlah = Tugas::where('dosen_id',$dosen->id)->where('kelas_id',$dt->id)->count();
            $formattedJumlah = $jumlah == 0 ? '0' : str_pad($jumlah, 2, '0', STR_PAD_LEFT);
            return $formattedJumlah;
        })
        ->editColumn('respon', function($dt){ 
            $jumlah = HasilTugas::where('kelas_id',$dt->id)->count();
            $formattedJumlah = $jumlah == 0 ? '0' : str_pad($jumlah, 2, '0', STR_PAD_LEFT);
            return $formattedJumlah;
        })
        ->addColumn('action', function($dt) {
            $urlTugas = route('d.task.respon',[Crypt::encrypt($dt->id)]);
            $button = '<a href="'.$urlTugas.'" class="btn btn-info">Lihat Tugas</a>';
            return $button;
        })    
        ->rawColumns(['no','jumlah_tugas','respon','action'])
        ->make(true);
    }

    public function statusTask($task_id, $status_kode)
    {
        $id = Crypt::decrypt($task_id);
        try {

            $tugasStatus = Tugas::whereId($id)->update([
                'status' => $status_kode,
            ]);

            if($tugasStatus){
                return redirect()->back()->with('on', "Berhasil Update Status Tugas");
            }

            return redirect()->back()->with('off', "Gagal Update Status Tugas");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

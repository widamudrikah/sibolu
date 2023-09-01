<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\HasilTugasRequest;
use App\Models\Dosen;
use App\Models\HasilTugas;
use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class HasilTugasMahasiswaController extends Controller
{
    public function index($task_id)
    {
        $id = Crypt::decrypt($task_id);
        $tugas = Tugas::find($id);
        if($tugas->jenis_tugas == 1){
            $jenis = "YouTube";
        }else{
            $jenis = "Blog, Artikel atau Lainnya";
        }
        $kelas = Kelas::find($tugas->kelas_id);
        $dosen = Dosen::find($tugas->dosen_id);

        $dateString = $tugas->tgl_deadline;
        $timestamp = strtotime($dateString);
        $tgl_dead = date("d-m-Y", $timestamp);

        return view('layouts.pages.mhs.send-task',[
            'tugas'    => $tugas,
            'jenis'    => $jenis,
            'kelas'    => $kelas,
            'dosen'    => $dosen,
            'tgl_dead' => $tgl_dead,
        ]);
    }

    public function sendTaskSave(HasilTugasRequest $request)
    {

        $hasilTugas                 = new HasilTugas();
        $hasilTugas->mahasiswa_id   = Auth::user()->mahasiswa->id;
        $hasilTugas->tugas_id       = $request->tugas_id;
        $hasilTugas->kelas_id       = $request->kelas_id;
        $hasilTugas->link_tugas     = $request->link_tugas;
        $hasilTugas->kendala        = $request->kendala;
        $hasilTugas->save();

        return redirect()->route('m.task.sent.view',Crypt::encrypt($request->kelas_id))->with("on","Berhasil mengirim tugas");

    }
}

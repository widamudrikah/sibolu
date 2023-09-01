<?php

namespace App\Helpers;

use App\Models\HasilTugas;
use App\Models\Mahasiswa;
use App\Models\Materi;
use App\Models\Tugas;
use Illuminate\Support\Facades\Crypt;

class ModalDosenHelper
{
    public static function lihatKendala($dt)
    {
        $tag = '<div class="modal fade" id="lihatKendala' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $mhs = Mahasiswa::find($dt->mahasiswa_id);
        $tag .= '<h4 class="modal-title">Kendala ' . $mhs->nama_mahasiswa . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<div class="modal-body p-3">';
        $tag .= '<p style="text-align:justify;">'.$dt->kendala.'</p style="text-align:justify;">';         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        return $tag;
    }

    public static function pesanDanNilai($dt)
    {
        $tag = '<div class="modal fade" id="pesandannilai' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $mhs = Mahasiswa::find($dt->mahasiswa_id);
        $tag .= '<h4 class="modal-title">Feedback ke ' . $mhs->nama_mahasiswa . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<form action="' . route("d.feedback") . '" method="POST" enctype="multipart/form-data">';
        $tag .= csrf_field();
        $tag .= '<div class="modal-body">';
        $tag .= '<input type="hidden" name="hasil_tugas_id" value="' . Crypt::encrypt($dt->id) . '">';

        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Nilai</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<input class="form-control" type="number" name="nilai" value="'.$dt->nilai.'">';
        $tag .= '</div>';
        $tag .= '</div>';

        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Pesan</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<textarea class="form-control" rows="3" name="komentar">'.$dt->komentar.'</textarea>';
        $tag .= '</div>';
        $tag .= '</div>';
         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '<button type="submit" class="btn btn-info">Submit</button>';
        $tag .= '</div>';
        $tag .= '</form>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';

        return $tag;
    }

    public static function lihatPesan($dt)
    {
        $tag = '<div class="modal fade" id="lihatPesan' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $mhs = Mahasiswa::find($dt->mahasiswa_id);
        $tag .= '<h4 class="modal-title">Pesan untuk ' . $mhs->nama_mahasiswa . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<div class="modal-body p-3">';
        $tag .= '<p style="text-align:justify;">'.$dt->komentar.'</p style="text-align:justify;">';         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        return $tag;
    }

    public static function lihatSoal($dt)
    {
        $tag = '<div class="modal fade" id="lihatSoal' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $tugas = Tugas::find($dt->id);
        $tag .= '<h4 class="modal-title">Soal Tugas-' . $tugas->tugas_ke . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<div class="modal-body p-3">';
        $tag .= '<p style="text-align:justify;">'.$dt->soal.'</p style="text-align:justify;">';         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        return $tag;
    }

    public static function lihatDeskripsi($dt)
    {
        $tag = '<div class="modal fade" id="lihatDeskripsi' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $tugas = Tugas::find($dt->id);
        $tag .= '<h4 class="modal-title">Deskripsi Tugas-' . $tugas->tugas_ke . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<div class="modal-body p-3" style="text-align:left !important;">';
        $tag .= $dt->deskripsi;         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        return $tag;
    }

    public static function lihatDeskripsiMateri($dt)
    {
        $tag = '<div class="modal fade" id="lihatDeskripsiMateri' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $dateString = $dt->tgl_materi;
        $timestamp = strtotime($dateString);
        $tgl_dead = date("d-m-Y", $timestamp);
        $tag .= '<h4 class="modal-title">Deskripsi Materi Tanggal ' . $tgl_dead . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<div class="modal-body p-3" style="text-align:left !important;">';
        $tag .= $dt->rincian_materi;         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        return $tag;
    }

    public static function lihatMateri($dt)
    {
        $tag = '<div class="modal fade" id="lihatMateri' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $dateString = $dt->tgl_materi;
        $timestamp = strtotime($dateString);
        $tgl_dead = date("d-m-Y", $timestamp);
        $tag .= '<h4 class="modal-title">Materi Tanggal ' . $tgl_dead . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<div class="modal-body p-3" style="text-align:center !important;">';  
        $tag .= '<h4>' . $dt->nama_materi . '</h4>';
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';
        return $tag;
    }
}
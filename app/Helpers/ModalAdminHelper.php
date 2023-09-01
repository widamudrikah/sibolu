<?php

namespace App\Helpers;

use App\Models\Dosen;
use App\Models\Tahun;
use Illuminate\Support\Facades\Crypt;

class ModalAdminHelper
{
    public static function modalEditJurusan($dt)
    {
        $tag = '<div class="modal fade" id="modalEditJurusan' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $tag .= '<h4 class="modal-title">' . $dt->nama_jurusan . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<form action="' . route("a.major.save.change") . '" method="POST" enctype="multipart/form-data">';
        $tag .= csrf_field();
        $tag .= '<div class="modal-body">';
        $tag .= '<input type="hidden" name="major_id" value="' . Crypt::encrypt($dt->id) . '">';

        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Jurusan :</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<input class="form-control" type="text" name="nama_jurusan" value="'.$dt->nama_jurusan.'">';
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

    public static function modalEditKelas($dt)
    {
        $tag = '<div class="modal fade" id="modalEditKelas' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $tag .= '<h4 class="modal-title">Edit Kelas ' . $dt->nama_kelas . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<form action="' . route("a.class.save.change") . '" method="POST" enctype="multipart/form-data">';
        $tag .= csrf_field();
        $tag .= '<div class="modal-body">';
        $tag .= '<input type="hidden" name="class_id" value="' . Crypt::encrypt($dt->id) . '">';

        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Nama Kelas :</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<input class="form-control" required type="text" name="nama_kelas" value="'.$dt->nama_kelas.'">';
        $tag .= '</div>';
        $tag .= '</div>';

        $dosen = Dosen::all();        
        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Dosen :</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<select required id="dosen_id" class="form-control" name="dosen_id">';
        $tag .= '<option value="">-- Pilih Dosen --</option>';
                foreach ($dosen as $dsn) {
                    $tag .= '<option value="' . $dsn->id . '"';
                    $tag .= $dt->dosen_id == $dsn->id ? ' selected' : '';
                    $tag .= '>' . $dsn->nama_dosen . '</option>';
                }
        $tag .= '</select>';        
        $tag .= '</div>';
        $tag .= '</div>';

        $tahun = Tahun::all();        
        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Tahun :</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<select required id="tahun_id" class="form-control" name="tahun_id">';
        $tag .= '<option value="">-- Pilih Tahun --</option>';
                foreach ($tahun as $thn) {
                    $tag .= '<option value="' . $thn->id . '"';
                    $tag .= $dt->tahun_id == $thn->id ? ' selected' : '';
                    $tag .= '>' . $thn->tahun . '</option>';
                }
        $tag .= '</select>';        
        $tag .= '</div>';
        $tag .= '</div>';
         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '<button type="submit" class="btn btn-info">Save Change</button>';
        $tag .= '</div>';
        $tag .= '</form>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';

        return $tag;
    }

    public static function modalEditYear($dt)
    {
        $tag = '<div class="modal fade" id="modalEditYear' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $tag .= '<h4 class="modal-title">Edit Tahun</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<form action="' . route("a.year.save.change") . '" method="POST" enctype="multipart/form-data">';
        $tag .= csrf_field();
        $tag .= '<div class="modal-body">';
        $tag .= '<input type="hidden" name="year_id" value="' . Crypt::encrypt($dt->id) . '">';

        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Tahun :</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<input class="form-control" type="text" name="tahun" value="'.$dt->tahun.'">';
        $tag .= '</div>';
        $tag .= '</div>';
         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '<button type="submit" class="btn btn-info">Save Change</button>';
        $tag .= '</div>';
        $tag .= '</form>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';

        return $tag;
    }
}
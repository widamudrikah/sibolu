<?php

namespace App\Helpers;

use App\Models\Tugas;

class ModalMhsHelper
{
    public static function editTugasTerkirim($dt)
    {
        $tag = '<div class="modal fade" id="editTugas' . $dt->id . '">';
        $tag .= '<div class="modal-dialog">';
        $tag .= '<div class="modal-content">';
        $tag .= '<div class="modal-header">';
        $tugas = Tugas::find($dt->tugas_id);
        $tag .= '<h4 class="modal-title">Edit Tugas-' . $tugas->tugas_ke . '</h4>';
        $tag .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $tag .= '</div>';
        $tag .= '<form action="' . route("m.task.edit") . '" method="POST" enctype="multipart/form-data">';
        $tag .= csrf_field();
        $tag .= '<div class="modal-body">';
        $tag .= '<input type="hidden" name="hasil_tugas_id" value="' . $dt->id . '">';

        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Link</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<textarea class="form-control" required rows="2" name="link_tugas">'.$dt->link_tugas.'</textarea>';
        $tag .= '</div>';
        $tag .= '</div>';

        $tag .= '<div class="form-group row">';
        $tag .= '<label class="col-form-label col-md-3 col-sm-3 text-left">Kendala</label>';
        $tag .= '<div class="col-md-9 col-sm-9 ">';
        $tag .= '<textarea class="form-control" required rows="3" name="kendala">'.$dt->kendala.'</textarea>';
        $tag .= '</div>';
        $tag .= '</div>';
         
        $tag .= '</div>';
        $tag .= '<div class="modal-footer">';
        $tag .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        $tag .= '<button type="submit" class="btn btn-primary">Submit</button>';
        $tag .= '</div>';
        $tag .= '</form>';
        $tag .= '</div>';
        $tag .= '</div>';
        $tag .= '</div>';

        return $tag;
    }

}
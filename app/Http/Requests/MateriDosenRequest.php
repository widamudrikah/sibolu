<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriDosenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'kelas_id'          => 'required',
            'tgl_materi'        => 'required',
            'nama_materi'       => 'required',
            'rincian_materi'    => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'kelas_id.required'         => 'Pilih kelas',
            'tgl_materi.required'       => 'Masukkan tanggal materi dibawakan',
            'nama_materi.required'      => 'Masukkan nama materi',
            'rincian_materi.required'   => 'Masukkan deskripsi materi',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TugasDosenRequest extends FormRequest
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
            'kelas_id'      => 'required',
            'jenis_tugas'   => 'required',
            'tugas_ke'      => 'required',
            'deadline'      => 'required',
            'jam'           => 'required',
            'soal'          => 'required',
            'deskripsi'     => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'kelas_id.required'         => 'Masukkan kelas',
            'jenis_tugas.required'      => 'Masukkan jenis tugas',
            'tugas_ke.required'         => 'Masukkan tugas ke berapa',
            'deadline.required'         => 'Masukkan tanggal batas waktu',
            'jam.required'              => 'Masukkan jam batas waktu',
            'soal.required'             => 'Masukkan soal',
            'deskripsi.required'        => 'Masukkan deskripsi soal',
        ];
    }
}

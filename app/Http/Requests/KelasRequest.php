<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
            'nama_kelas'    => 'required|unique:kelas',
            'tahun_id'      => 'required',
            'dosen_id'      => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kelas.required'   => 'Masukkan nama kelas',
            'nama_kelas.unique'     => 'Nama kelas telah ada',
            'tahun_id.required'     => 'Masukkan tahun berjalan',
            'dosen_id.required'     => 'Masukkan nama dosen pengajar',
        ];
    }
}

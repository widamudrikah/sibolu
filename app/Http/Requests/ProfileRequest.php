<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'tempat_lahir'         => 'required',
            'tgl_lahir'            => 'required',
            'telp'                 => 'required|unique:mahasiswas',
            'alasan'               => 'required',
            'foto'                 => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'tempat_lahir.required'        => 'Masukkan tempat lahir',
            'tgl_lahir.required'           => 'Masukkan tanggal lahir',
            'telp.required'                => 'Masukkan nomor telepon',
            'telp.unique'                  => 'Nomor telepon telah terdaftar',
            'alasan.required'              => 'Masukkan alasan memilih IDN',
            'foto.required'                => 'Pas foto 3x4 harus diupload',
            'foto.image'                   => 'File yang diunggah harus berupa gambar.',
            'foto.mimes'                   => 'Format gambar tidak valid. Format yang diizinkan: jpeg, png, jpg, gif.',
            'foto.max'                     => 'Ukuran file foto melebihi batas maksimal 2MB.',
        ];
    }
}

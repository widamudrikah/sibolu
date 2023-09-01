<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
            'email'             => 'required|unique:users',
            // 'password'          => 'required',
            'nama_mahasiswa'    => 'required',
            'jurusan_id'        => 'required',
            'gender'            => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'            => 'Masukkan email',
            'email.unique'              => 'Email telah digunakan',
            'password.required'         => 'Masukkan password',
            'nama_mahasiswa.required'   => 'Masukkan nama lengkap mahasiswa',
            'jurusan_id.required'       => 'Masukkan jurusan',
            'gender.required'           => 'Masukkan jenis kelamin',
        ];
    }
}

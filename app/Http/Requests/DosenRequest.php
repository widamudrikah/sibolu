<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
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
            // 'nidn'          => 'unique:users',
            'email'         => 'required|unique:users',
            'password'      => 'required',
            'nama_dosen'    => 'required',
            'gender'        => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nidn.unique'           => 'Nidn telah terdaftar',
            'email.required'        => 'Masukkan email',
            'email.unique'          => 'Email telah terdaftar',
            'password.required'     => 'Masukkan password',
            'nama_dosen.required'   => 'Masukkan nama lengkap',
            'gender.required'       => 'Masukkan jenis kelamin',
        ];
    }
}

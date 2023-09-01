<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HasilTugasRequest extends FormRequest
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
            'link_tugas'      => 'required|url',
            'kendala'         => 'required|min:20',
        ];
    }

    public function messages(): array
    {
        return [
            'link_tugas.required'   => 'Masukkan link tugas sesuai jenis tugas yang diminta',
            'link_tugas.url'        => 'Masukkan link tugas yang valid',
            'kendala.required'      => 'Beri tahu kendala anda selama mengerjakan tugas ini',
            'kendala.min'           => 'Terlalu singkat',
        ];
    }
}

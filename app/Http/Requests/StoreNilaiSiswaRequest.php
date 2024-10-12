<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNilaiSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'siswa_id' => 'required|exists:d_siswa,siswa_id',
            'nilai_siswa_count.*' => 'required|integer|min:0|max:100',
            'sub_kriteria_id.*' => 'required|exists:m_sub_kriteria,sub_kriteria_id',
        ];
    }

    public function messages()
    {
        return [
            'siswa_id.required' => 'Nama siswa harus diisi',
            'nilai_siswa_count.*.required' => 'Nilai harus diisi',
            'nilai_siswa_count.*.integer' => 'Nilai harus berupa angka',
            'nilai_siswa_count.*.min' => 'Nilai minimal adalah 0',
            'nilai_siswa_count.*.max' => 'Nilai maksimal adalah 100',
            'sub_kriteria_id.*.required' => 'Sub kriteria harus diisi',
        ];
    }
}

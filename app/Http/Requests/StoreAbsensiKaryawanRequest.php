<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsensiKaryawanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'namaKaryawan' => 'required',
            'tanggalMasuk' => 'required',
            'waktuMasuk' => 'required',
            'status' => 'required',
            'waktuKeluar' => 'required'
        ];
    }
}

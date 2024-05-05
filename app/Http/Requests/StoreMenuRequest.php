<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'kategori_id' => 'required',
            'nama_menu' => 'required',
            'harga' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceRequest extends FormRequest implements StoreRequestContract, UpdateRequestContract
{
    /**
     * Aturan validasi yang berlaku untuk permintaan.
     */
    public function rules(): array
    {
        return [
            'id_mesin' => 'required|uuid|exists:mesin,id',
            'description' => 'required|string|max:65535',
            'in_progress' => 'boolean',
        ];
    }

    /**
     * Pesan error kustom.
     */
    public function messages(): array
    {
        return [
            'id_mesin.required' => 'ID mesin wajib diisi.',
            'id_mesin.uuid' => 'ID mesin harus berupa UUID yang valid.',
            'id_mesin.exists' => 'ID mesin yang dipilih tidak valid.',
            'description.required' => 'Deskripsi pemeliharaan wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi tidak boleh lebih dari 65535 karakter.',
            'in_progress.boolean' => 'Status harus berupa nilai boolean.',
        ];
    }
}

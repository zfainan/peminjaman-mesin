<?php

namespace App\Http\Requests;

use App\Enums\JabatanEnum;
use App\Models\Jabatan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest implements StoreRequestContract, UpdateRequestContract
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $jabatanKepalaId = Jabatan::firstWhere('nama_jabatan', JabatanEnum::KEPALA_LANE->value)
            ->id;
        $userId = $this->route('user');

        return [
            'nama' => 'required',
            'username' => [
                'required',
                "unique:karyawan,username,$userId,id"
            ],
            'password' => [
                'min:8',
                'nullable',
                Rule::requiredIf(!$userId),
                Rule::excludeIf($userId && $this->password == null)
            ],
            'lane' =>  [
                Rule::requiredIf($this->id_jabatan == $jabatanKepalaId),
                Rule::excludeIf($this->id_jabatan != $jabatanKepalaId)
            ],
            'id_jabatan' => 'required|exists:jabatan,id',
        ];
    }
}

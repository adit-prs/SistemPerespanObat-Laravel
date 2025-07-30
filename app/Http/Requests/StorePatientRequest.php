<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'date-of-birth' => 'required|date',
            'gender' => 'required|in:L,P',
            'phone-number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'gender.in' => 'Kelamin harus laki-laki atau perempuan.',
            'phone.required' => 'Nomor telepon tidak boleh kosong.',
            'date-of-birth.required' => 'Tanggal lahir wajib diisi.',
            'date-of-birth.date' => 'Format tanggal lahir tidak valid.',
        ];
    }
}

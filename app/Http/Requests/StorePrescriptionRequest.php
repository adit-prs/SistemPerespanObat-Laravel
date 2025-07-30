<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
            'examination_id' => 'required|uuid',
            'items' => 'required|array|min:1',

            'items.*.id' => 'required|uuid',
            'items.*.medicine' => 'required|string|max:255',
            'items.*.dosage' => 'required|string|max:100',
            'items.*.dosage_schedule' => 'required|array|min:1',
            'items.*.frequency' => 'required|string|max:100',
            'items.*.duration' => 'required|string|max:100',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.instructions' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'examination_id.required' => 'ID pemeriksaan wajib diisi.',
            'items.required' => 'Setidaknya satu item obat harus ditambahkan.',
            'items.*.id.required' => 'ID obat wajib diisi.',
            'items.*.dosage_schedule.required' => 'Jadwal konsumsi harus dipilih.',
            'items.*.quantity.integer' => 'Jumlah harus berupa angka.',
        ];
    }
}

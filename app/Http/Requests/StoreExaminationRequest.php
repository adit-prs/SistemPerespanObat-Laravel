<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationRequest extends FormRequest
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
            'exam_date' => 'required|date',
            'height' => 'required|numeric|min:0|max:300',
            'weight' => 'required|numeric|min:0|max:300',
            'systolic' => 'required|integer|min:50|max:300',
            'diastolic' => 'required|integer|min:30|max:200',
            'heart_rate' => 'required|integer|min:30|max:250',
            'respiratory_rate' => 'required|integer|min:10|max:60',
            'temperature' => 'required|numeric|min:20|max:50',
            'diagnosis' => 'required|string|max:500',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'exam_date.required' => 'Tanggal pemeriksaan wajib diisi.',
            'exam_date.date' => 'Format tanggal pemeriksaan tidak valid.',

            'height.required' => 'Tinggi badan wajib diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
            'height.max' => 'Tinggi badan tidak boleh lebih dari 300 cm.',

            'weight.required' => 'Berat badan wajib diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'weight.max' => 'Berat badan tidak boleh lebih dari 500 kg.',

            'systolic.required' => 'Sistol wajib diisi.',
            'systolic.integer' => 'Sistol harus berupa angka bulat.',

            'diastolic.required' => 'Diastol wajib diisi.',
            'diastolic.integer' => 'Diastol harus berupa angka bulat.',

            'heart_rate.required' => 'Heart rate wajib diisi.',
            'heart_rate.integer' => 'Heart rate harus berupa angka bulat.',

            'respiratory_rate.required' => 'Respiratory rate wajib diisi.',
            'respiratory_rate.integer' => 'Respiratory rate harus berupa angka bulat.',

            'temperature.required' => 'Suhu tubuh wajib diisi.',
            'temperature.numeric' => 'Suhu tubuh harus berupa angka.',

            'diagnosis.required' => 'Diagnosis tidak boleh kosong.',
            'diagnosis.max' => 'Diagnosis maksimal 500 karakter.',
        ];
    }
}

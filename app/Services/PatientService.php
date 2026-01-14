<?php

namespace App\Services;


use App\Models\patients;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class PatientService
{
    public function getDataTable()
    {
        return DataTables::of(patients::query())
            ->addColumn('action', function ($row) {
                $url = route('patients.show', $row->id);

                return '<a href="'.$url.'" class="btn-detail text-blue-500 hover:underline">Detail</a>';
            })
            ->rawColumns(['action']) // supaya HTML tidak di-escape
            ->make(true);
    }

    public function create(array $data)
    {
        $lastNumber = patients::max('medical_record_number');
        $lastNumber = $lastNumber ? (int)preg_replace('/[^0-9]/', '', $lastNumber) : 0;
        $newNumber = $lastNumber + 1;
        $medical_record_number = 'NP-'.str_pad($newNumber, 6, '0', STR_PAD_LEFT);

        return patients::create([
            'medical_record_number' => $medical_record_number,
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birth_date' => $this->convertToDbDate($data['birth_date']),
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);
    }

    public function convertToDbDate(string $date)
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    public function getById($id): patients
    {
        return patients::findOrFail($id);
    }

    public function update(patients $patient, array $data)
    {
        $patient->update([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'address' => $data['address'] ?? null,
            'phone_number' => $data['phone_number'] ?? null,
        ]);

        return $patient;
    }

    public function delete(patients $patient)
    {
        return (bool)$patient->delete();
    }
}
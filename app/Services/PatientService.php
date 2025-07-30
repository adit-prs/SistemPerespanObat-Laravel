<?php

namespace App\Services;

use App\models\Patient;
use Carbon\Carbon;

class PatientService
{
    public function getAllPatients()
    {
        return Patient::all();
    }

    public function getPatientById($id)
    {
        return Patient::findOrFail($id);
    }

    public function createPatient(array $data)
    {
        return Patient::create([
            'medical_record_number' => $this->generatePatientNumber(),
            'name' => $data['name'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date-of-birth'],
            'address' => $data['address'],
            'phone_number' => $data['phone-number'],
        ]);
    }

    public function generatePatientNumber()
    {
        $date = Carbon::now()->format('Ymd');
        $prefix = 'PSN' . $date;
        $countToday = Patient::whereDate('created_at', Carbon::today())->count() + 1;
        $number = str_pad($countToday, 4, '0', STR_PAD_LEFT);
        return $prefix . '-' . $number;
    }

    public function getInitialsAttribute()
    {
        $words = explode(' ', trim($this->name));
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }

        return $initials;
    }

}
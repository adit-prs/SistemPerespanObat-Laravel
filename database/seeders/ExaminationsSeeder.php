<?php

namespace Database\Seeders;

use App\Models\examinations;
use Illuminate\Database\Seeder;

class ExaminationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $doctors = [
            'dceffa92-b61f-4c20-87f7-e8f034f7cc87', // John Doe
            '9e5c699e-0744-4d72-9a9c-7c2e6a2c3d43', // Sarah Johnson
        ];

        $patients = [
            'c4a2bcd9-6c46-4a74-9b63-29d0ed548621',
            '1c4a7366-7907-48c7-9aea-19e580b5b3db',
            '7d93624b-26e6-46cf-a0a4-9bd871eebeca',
        ];

        examinations::insert([
            [
                'id' => '1c4a7366-7907-48c7-9aea-19e580b5b3db',
                'doctor_id' => $doctors[0],
                'patient_id' => $patients[0],
                'examined_at' => '2026-01-04',
                'chief_complaint' => 'Pusing sejak 2 hari',
                'general_condition' => 'sedang',
                'consciousness' => 'compos_mentis',
                'height_cm' => 170,
                'weight_kg' => 65,
                'systole' => 120,
                'diastole' => 80,
                'heart_rate' => 78,
                'respiratory_rate' => 18,
                'temperature_c' => 36.8,
                'diagnosis' => 'Vertigo ringan',
            ],
            [
                'id' => '2f7b9d44-2e5a-4e9b-8c1f-0ad3b2c4d5e6',
                'doctor_id' => $doctors[1],
                'patient_id' => $patients[1],
                'examined_at' => '2026-01-07',
                'chief_complaint' => 'Demam dan batuk',
                'general_condition' => 'sedang',
                'consciousness' => 'compos_mentis',
                'height_cm' => 160,
                'weight_kg' => 55,
                'systole' => 110,
                'diastole' => 70,
                'heart_rate' => 90,
                'respiratory_rate' => 20,
                'temperature_c' => 38.2,
                'diagnosis' => 'Influenza',
            ],
            [
                'id' => '3a9c5b88-4f21-4d3e-9b7a-12c4e5f6a7b8',
                'doctor_id' => $doctors[0],
                'patient_id' => $patients[1],
                'examined_at' => '2026-01-09',
                'chief_complaint' => 'Sesak napas saat aktivitas',
                'general_condition' => 'buruk',
                'consciousness' => 'somnolen',
                'height_cm' => 175,
                'weight_kg' => 70,
                'systole' => 140,
                'diastole' => 95,
                'heart_rate' => 102,
                'respiratory_rate' => 26,
                'temperature_c' => 37.4,
                'diagnosis' => 'Hipertensi',
            ],
            [
                'id' => '4d2e7c11-6a3b-4f9c-8d2e-23b5c6d7e8f9',
                'doctor_id' => $doctors[1],
                'patient_id' => $patients[0],
                'examined_at' => '2026-01-11',
                'chief_complaint' => 'Nyeri perut dan mual',
                'general_condition' => 'sedang',
                'consciousness' => 'compos_mentis',
                'height_cm' => 158,
                'weight_kg' => 52,
                'systole' => 115,
                'diastole' => 75,
                'heart_rate' => 85,
                'respiratory_rate' => 19,
                'temperature_c' => 37.8,
                'diagnosis' => 'Gastritis akut',
            ],
            [
                'id' => '5e8f1a22-9b4c-4e1d-9f3a-34c6d7e8f9a0',
                'doctor_id' => $doctors[1],
                'patient_id' => $patients[2],
                'examined_at' => '2026-01-13',
                'chief_complaint' => 'Kelelahan dan pegal otot',
                'general_condition' => 'baik',
                'consciousness' => 'compos_mentis',
                'height_cm' => 168,
                'weight_kg' => 60,
                'systole' => 118,
                'diastole' => 78,
                'heart_rate' => 82,
                'respiratory_rate' => 18,
                'temperature_c' => 36.7,
                'diagnosis' => 'Overfatigue',
            ],
        ]);
    }
}

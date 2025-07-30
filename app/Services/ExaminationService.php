<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\Examination;
use Illuminate\Support\Facades\Auth;

class ExaminationService
{
    public function getAll()
    {
        return Examination::all();
    }

    public function getById($id)
    {
        return Examination::where('id', $id)->first();
    }

    public function getByPatientId($idPatient)
    {
        return Examination::where('patient_id', $idPatient)->get();
    }

    public function create(string $id, array $data)
    {
        $createExam = Examination::create([
            'doctor_id' => Auth::id(),
            'patient_id' => $id,
            'examined_at' => $data['exam_date'],
            'height_cm' => $data['height'],
            'weight_kg' => $data['weight'],
            'systole' => $data['systolic'],
            'diastole' => $data['diastolic'],
            'heart_rate' => $data['heart_rate'],
            'respiratory_rate' => $data['respiratory_rate'],
            'temperature_c' => $data['temperature'],
            'diagnosis' => $data['diagnosis'],
        ]);

//        dd($createExam);
        $crateAttachments = [];
        if (isset($data['attachments'])) {
            foreach ($data['attachments'] as $file) {
                $path = $file->store('attachments', 'public');
                $crateAttachments[] = Attachment::create([
                    'examination_id' => $createExam->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }
        $result = [$createExam, $crateAttachments];
        return $result;
    }
}
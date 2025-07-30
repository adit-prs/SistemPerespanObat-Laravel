<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExaminationRequest;
use App\Services\ExaminationService;
use App\Services\PatientService;
use Carbon\Carbon;

class ExaminationController extends Controller
{
    protected $patientService;
    protected $examinationService;

    public function __construct()
    {
        $this->patientService = new PatientService();
        $this->examinationService = new ExaminationService();
    }

    //
    public function index($id)
    {
        $patient = $this->patientService->getPatientById($id);
        $patient->age = Carbon::parse($patient->date_of_birth)->age;
        return view('doctor.addExamination', compact('patient'));
    }

    public function store(StoreExaminationRequest $request, $id)
    {
        $create = $this->examinationService->create($id, $request->validated());
        if ($request->input('action') === 'save_and_prescribe') {
            return redirect()->route('prescriptions.index', [
                'id' => $id,
                'idCheckUp' => $create[0]->id,
            ]);
        }
        return redirect()->route('patient.show', $id)->with('success', 'Pemerikasaan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $patient = $this->patientService->getPatientById($id);
        $patient->age = Carbon::parse($patient->date_of_birth)->age;

        return view('doctor.patientDetail', compact('patient'));
    }
}

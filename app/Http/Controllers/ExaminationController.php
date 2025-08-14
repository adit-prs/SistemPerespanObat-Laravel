<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExaminationRequest;
use App\Services\ExaminationService;
use App\Services\PatientService;
use App\Services\PrescriptionService;
use Carbon\Carbon;

class ExaminationController extends Controller
{
    protected $patientService;
    protected $examinationService;

    protected $prescriptionService;

    public function __construct()
    {
        $this->patientService = new PatientService();
        $this->examinationService = new ExaminationService();
        $this->prescriptionService = new PrescriptionService();
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

    public function show($id, $idCheckUp)
    {
        $patient = $this->patientService->getPatientById($id);
        $patient->age = Carbon::parse($patient->date_of_birth)->age;
        $examinations = $this->examinationService->getById($idCheckUp);
        $examinations->visit = Carbon::parse($examinations['examined_at'])->format('d M Y');
        $attachments = $this->examinationService->getAttachmentsByExaminationId($examinations['id']);
        $prescription = $this->prescriptionService->getByExamId($idCheckUp);
        return view('doctor.examinationDetail', compact('patient', 'examinations', 'attachments', 'prescription'));
    }
}

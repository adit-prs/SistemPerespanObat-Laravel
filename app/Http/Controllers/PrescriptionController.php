<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrescriptionRequest;
use App\Services\ApiExtService;
use App\Services\ExaminationService;
use App\Services\PatientService;
use App\Services\PrescriptionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    protected $patientService;
    protected $examinationService;
    protected $apiExtService;
    protected $prescriptionService;

    public function __construct()
    {
        $this->patientService = new PatientService();
        $this->examinationService = new ExaminationService();
        $this->apiExtService = new ApiExtService();
        $this->prescriptionService = new PrescriptionService();
    }

    //
    public function index($id, $idCheckUp)
    {
        $patient = $this->patientService->getPatientById($id);
        $patient->age = Carbon::parse($patient->date_of_birth)->age;
        $medicines = $this->apiExtService->getMedicineList()['medicines'] ?? [];
        $doctor = Auth::user();
        return view('doctor.addPrescription', compact('patient', 'medicines', 'doctor', 'idCheckUp'));
    }

    public function store($id, $idCheckUp, StorePrescriptionRequest $request)
    {
        $examDate = $this->examinationService->getById($idCheckUp)['examined_at'];
        $medicines = $this->prescriptionService->createIndex($request->validated(), $examDate);
        return $medicines;
    }
}

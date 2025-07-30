<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Models\User;
use App\Services\ExaminationService;
use App\Services\PatientService;
use App\Services\PrescriptionService;
use Carbon\Carbon;

class PatientController extends Controller
{
    //
    protected $patientService;
    protected $examinationService;
    protected $prescriptionService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
        $this->examinationService = new ExaminationService();
        $this->prescriptionService = new PrescriptionService();
    }

    public function index()
    {
        $patients = $this->patientService->getAllPatients();
        foreach ($patients as $patient) {
            $patient->age = Carbon::parse($patient->date_of_birth)->age;
            $examinations = $this->examinationService->getByPatientId($patient->id);
            $latestExam = collect($examinations)->sortByDesc('examined_at')->first();
            $patient->lastVisit = $latestExam ? Carbon::parse($latestExam['examined_at'])->format('d M Y') : null;
        }
        return view('doctor.patientsList', compact('patients'));
    }

    public function store(StorePatientRequest $request)
    {
        $this->patientService->createPatient($request->validated());
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function show($id)
    {
        $patient = $this->patientService->getPatientById($id);
        $patient->age = Carbon::parse($patient->date_of_birth)->age;
        $examinations = $this->examinationService->getByPatientId($patient->id);
        $prescription = $this->prescriptionService->getAll($patient->id);
        $patient->totalVisit = count($examinations);
        $latestExam = collect($examinations)->sortByDesc('examined_at')->first();
        $patient->lastVisit = $latestExam ? Carbon::parse($latestExam['examined_at'])->format('d M Y') : null;

        foreach ($examinations as $examination) {
            $examination->date = Carbon::parse($examination['examined_at'])->format('d M Y');
            $examination->doctor = User::where('id', $examination['doctor_id'])->value('name');
        }

        return view('doctor.patientDetail', compact('patient', 'examinations', 'prescription'));
    }


}

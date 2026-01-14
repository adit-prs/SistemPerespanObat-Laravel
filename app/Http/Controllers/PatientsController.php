<?php

namespace App\Http\Controllers;

use App\Models\patients;
use App\Services\ExaminationService;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    protected PatientService $patientService;
    protected ExaminationService $examinationService;

    public function __construct(PatientService $patientService, ExaminationService $examinationService)
    {
        $this->patientService = $patientService;
        $this->examinationService = $examinationService;
    }

    public function index()
    {
        return view('pages.patients.index');
    }

    public function data()
    {
        return $this->patientService->getDataTable();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:L,P'],
            'birth_date' => ['required', 'date'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $this->patientService->create($validated);

        return redirect()
            ->route('patients')
            ->with('success', 'Pasien berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = $this->patientService->getById($id);

        return view('pages.patients.detail', compact('patient'));
    }

    public function examinationData($id)
    {
        return $this->examinationService->getAllTables($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(patients $patients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, patients $patients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(patients $patients)
    {
        //
    }

}

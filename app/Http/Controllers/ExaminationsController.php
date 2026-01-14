<?php

namespace App\Http\Controllers;

use App\Models\examinations;
use App\Services\ExaminationService;
use App\Services\MedicineService;
use App\Services\PatientService;
use Illuminate\Http\Request;

class ExaminationsController extends Controller
{
    protected MedicineService $medicineService;
    protected PatientService $patientService;
    protected ExaminationService $examinationService;

    public function __construct(
        MedicineService $medicineService,
        PatientService $patientService,
        ExaminationService $examinationService
    ) {
        $this->medicineService = $medicineService;
        $this->patientService = $patientService;
        $this->examinationService = $examinationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $patient = $this->patientService->getById($id);
        $medicines = $this->medicineService->getList()['medicines'];

        return view('pages.examinations.index', compact('medicines', 'patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'chief_complaint' => ['required', 'string'],
                'general_condition' => ['required', 'in:baik,sedang,buruk'],
                'consciousness' => ['required', 'in:compos_mentis,apatis,somnolen,sopor,koma'],
                'height_cm' => ['required', 'numeric', 'min:0'],
                'weight_kg' => ['required', 'numeric', 'min:0'],
                'systole' => ['required', 'numeric', 'min:0'],
                'diastole' => ['required', 'numeric', 'min:0'],
                'heart_rate' => ['required', 'numeric', 'min:0'],
                'respiratory_rate' => ['required', 'numeric', 'min:0'],
                'temperature' => ['required', 'numeric', 'min:0'],
                'diagnosis' => ['required', 'string'],
                'attachments.*' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                'medicine_id' => ['nullable', 'array'],
                'medicine_id.*' => ['required', 'string'],
                'medicine_name' => ['nullable', 'array'],
                'medicine_name.*' => ['required', 'string'],
                'dosage_frequency' => ['nullable', 'array'],
                'dosage_frequency.*' => ['required', 'integer', 'min:1'],
                'dosage_amount' => ['nullable', 'array'],
                'dosage_amount.*' => ['required', 'integer', 'min:1'],
                'dosage_unit' => ['nullable', 'array'],
                'dosage_unit.*' => ['required', 'in:tablet,kapsul,saset,sendok'],
                'quantity' => ['nullable', 'array'],
                'quantity.*' => ['required', 'integer', 'min:1'],
                'additional_instruction' => ['nullable', 'array'],
                'additional_instruction.*' => ['nullable', 'string'],
            ]);
            $validated['patient_id'] = $id;
            $files = $request->file('attachments', []);

            $this->examinationService->create($validated, $files);

            return redirect()
                ->route('patients.show', $id)
                ->with('success', 'Data pemeriksaan berhasil disimpan');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan, data batal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $examineId)
    {
        //
        $patient = $this->patientService->getById($id);

        return view('pages.examinations.detail', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(examinations $examinations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, examinations $examinations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(examinations $examinations)
    {
        //
    }
}

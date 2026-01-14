<?php

namespace App\Http\Controllers;

use App\Services\MedicineService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PrescriptionsController extends Controller
{
    protected $medicineService;
    protected $paymentsService;

    public function __construct(MedicineService $medicineService, PaymentService $paymentsService)
    {
        $this->medicineService = $medicineService;
        $this->paymentsService = $paymentsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.prescriptions.index');
    }

    public function listPrescriptionsDataTable($status = null)
    {
        return $this->medicineService->getAllTables($status);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $patient = $this->medicineService->getPrescriptionDetail($id)->examinations->patient;
        $dataItems = $this->medicineService->getPrescriptionItem($id);
        $paymentId = $this->paymentsService->getByIdPrescription($id)->id ?? null;

        return view('pages.prescriptions.detail', compact('patient', 'dataItems', 'paymentId'));
    }

    public function editStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:draft,menunggu,diproses,diambil,dibatalkan'],
            'amount_due' => ['required', 'numeric'],
        ]);
        $this->medicineService->updatePrescriptionStatus($id, $validated['status']);

        $statusPembayaran = '';
        if ($validated['status'] == 'diproses') {
            $statusPembayaran = 'belum_dibayar';
        } elseif ($validated['status'] == 'dibatalkan') {
            $statusPembayaran = 'dibatalkan';
        }
        $this->paymentsService->create(
            ['prescription_id' => $id, 'status' => $statusPembayaran, 'amount_due' => $validated['amount_due']]
        );

        return redirect()->route('prescriptions.show', $id)->with('status', 'Data Berhasil diUpdate!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}

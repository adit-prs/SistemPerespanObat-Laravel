<?php

namespace App\Http\Controllers;

use App\Models\payments;
use App\Services\MedicineService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    protected $paymentsService;
    protected $medicineService;

    public function __construct(PaymentService $paymentsService, MedicineService $medicineService)
    {
        $this->paymentsService = $paymentsService;
        $this->medicineService = $medicineService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payments $payments)
    {
        //
    }

    public function updatePayment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount_due' => ['required', 'numeric'],
            'amount_paid' => ['required', 'numeric'],
            'method' => ['required', 'in:tunai,kartu,transfer,qris'],
        ]);

        $result = $this->paymentsService->processPayment($validatedData, $id);

        return redirect()->route('prescriptions.show', $result)->with('status', 'Data Berhasil diUpdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payments $payments)
    {
        //
    }

    public function downloadReceipt($id)
    {
        $receiptName = $this->paymentsService->getReceipt($id)->prescription->receipt_number;
        $pdf = $this->paymentsService->receiptPDF($id);

        return $pdf->download('nota-pembayaran-'.$receiptName.'.pdf');
    }
}

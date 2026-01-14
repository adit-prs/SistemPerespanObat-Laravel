<?php

namespace App\Services;

use App\Models\payments;
use App\Models\prescriptions;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function getByIdPrescription($id)
    {
        return payments::firstWhere('prescription_id', $id);
    }

    public function getById($id)
    {
        return payments::find($id);
    }

    public function getReceipt($id)
    {
        return payments::with('prescription.examinations')->find($id);
    }

    public function create(array $data)
    {
        $query = payments::updateOrCreate(['prescription_id' => $data['prescription_id']], $data);

        return $query;
    }

    public function processPayment(array $data, $id)
    {
        DB::beginTransaction();
        try {
            $data['status'] = 'lunas';
            $query = payments::updateOrCreate(['id' => $id], $data);

            $updateStatusPrescription = prescriptions::where('id', $query->prescription_id)->update([
                'status' => 'diambil',
            ]);
            DB::commit();

            return $query->prescription_id;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function receiptPDF($id)
    {
        $payment = payments::with(['prescription.prescriptionitems', 'prescription.examinations'])->findOrFail($id);
//        dd($payment->prescription->examinations);
        $pdf = Pdf::loadView('pdf.receipt', [
            'payment' => $payment,
            'examination' => $payment->prescription->examinations,
            'prescription' => $payment->prescription,
            'items' => $payment->prescription?->prescriptionitems ?? collect(),
        ])->setPaper('A5', 'portrait');

        return $pdf;
    }
}
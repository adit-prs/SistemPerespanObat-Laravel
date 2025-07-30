<?php

namespace App\Services;

use App\Models\Prescription;
use App\Models\PrescriptionItem;

class PrescriptionService
{
    protected $apiExt;

    public function __construct()
    {
        $this->apiExt = new ApiExtService();
    }

    public function getAll($idPatiend)
    {
        $listPrescription = Prescription::with('examination')->whereHas(
            'examination',
            function ($query) use ($idPatiend) {
                $query->where('patient_id', $idPatiend);
            }
        )->get();
    }

    public function getById($id)
    {
    }

    public function createIndex($data, $examDate)
    {
        $receiptNumber = 'RCP-' . now()->format('YmdHis') . rand(1000, 9999);
        $prescription = Prescription::create([
            'examination_id' => $data['examination_id'],
            'receipt_number' => $receiptNumber,
        ]);

        $item = [];
        foreach ($data['items'] as $key => $item) {
            $dosage = implode(', ', $item['dosage_schedule']);
            $priceList = $this->apiExt->getMedicinePrice($item['id'])['prices'];
            $price = $this->getLatestPriceByTanggal($priceList, $examDate);

            $item[] = PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'medicine_id' => $item['id'],
                'medicine_name' => $item['medicine'],
                'price' => $price,
                'quantity' => $item['quantity'],
                'dosage' => $item['dosage'],
                'frequency' => $item['frequency'],
                'duration' => $item['duration'],
                'dosage_schedule' => $dosage,
                'instructions' => $item['instructions']
            ]);
        }
        return [
            'prescription' => $prescription,
            'items' => $item,
        ];
    }


    protected function getLatestPriceByTanggal(array $prices, string $tanggal): ?int
    {
        $candidates = array_filter($prices, function ($price) use ($tanggal) {
            $start = $price['start_date']['value'];
            $end = $price['end_date']['value'];

            return $start <= $tanggal && (is_null($end) || $tanggal <= $end);
        });

        if (empty($candidates)) {
            return null;
        }

        usort($candidates, function ($a, $b) {
            return strtotime($b['start_date']['value']) - strtotime($a['start_date']['value']);
        });

        return $candidates[0]['unit_price'];
    }


}
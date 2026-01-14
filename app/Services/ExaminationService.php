<?php

namespace App\Services;

use App\Models\attachments;
use App\Models\examinations;
use App\Models\prescription_items;
use App\Models\prescriptions;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ExaminationService
{
    protected $medicine;

    public function __construct(MedicineService $medicine)
    {
        $this->medicine = $medicine;
    }

    public function getAllTables($id)
    {
        $query = examinations::where('patient_id', $id)->select(['id', 'examined_at', 'chief_complaint', 'diagnosis']);

        return DataTables::of($query)
            ->editColumn('examined_at', function ($row) {
                return Carbon::parse($row->examined_at)->format('d/m/Y');
            })
            ->addColumn('action', function ($row) use ($id) {
                $url = route('patients.examine.show', ['id' => $id, 'examineId' => $row->id]);

//                return '<a href="'.$url.'" class="btn-detail text-blue-500 hover:underline">Detail</a>';
                return '<a href="#" class="btn-detail text-blue-500 hover:underline">Detail</a>';
            }
            )
            ->rawColumns(['action']) // supaya HTML tidak di-escape
            ->make(true);
    }

    public function create(array $data, array $files = [])
    {
        DB::beginTransaction();
        try {
            $examination = examinations::create([
                'doctor_id' => auth()->user()->id,
                'patient_id' => $data['patient_id'],
                'examined_at' => now(),
                'chief_complaint' => $data['chief_complaint'],
                'general_condition' => $data['general_condition'],
                'consciousness' => $data['consciousness'],
                'height_cm' => $data['height_cm'],
                'weight_kg' => $data['weight_kg'],
                'systole' => $data['systole'],
                'diastole' => $data['diastole'],
                'heart_rate' => $data['heart_rate'],
                'respiratory_rate' => $data['respiratory_rate'],
                'temperature_c' => $data['temperature'],
                'diagnosis' => $data['diagnosis'],
            ]);

            foreach ($files as $file) {
                if (!$file instanceof UploadedFile) {
                    continue;
                }

                $path = $file->store('examination_files', 'public');

                attachments::create([
                    'examination_id' => $examination->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }

            if (empty($data['medicine_id'])) {
                DB::commit();

                return $examination;
            }

            $prescribing = prescriptions::create([
                'examination_id' => $examination->id,
                'status' => 'menunggu',
            ]);

            foreach ($data['medicine_id'] as $i => $medicineId) {
                $medicinePrice = $this->medicine->getTodayPrice($medicineId)['unit_price'];

                prescription_items::create([
                    'prescription_id' => $prescribing['id'],
                    'medicine_id' => $medicineId,
                    'medicine_name' => $data['medicine_name'][$i],
                    'dosage_frequency' => $data['dosage_frequency'][$i],
                    'dosage_amount' => $data['dosage_amount'][$i],
                    'dosage_unit' => $data['dosage_unit'][$i],
                    'quantity' => $data['quantity'][$i],
                    'unit_price' => $medicinePrice,
                    'additional_instruction' => $data['additional_instruction'][$i] ?? null,
                ]);
            }
            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById($id)
    {
    }

}
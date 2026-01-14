<?php

namespace Database\Seeders;

use App\Models\prescription_items;
use Illuminate\Database\Seeder;

class PrescriptionItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        prescription_items::insert([
            // Examination 1 - Vertigo ringan
            [
                'id' => '701f4d3e-4e3d-446b-90fd-d9dfb738b601',
                'prescription_id' => '8b7c9e10-2d34-4f56-8a78-9b0c1d2e3f40',
                'medicine_id' => '9cf72984-05b8-40d7-9cee-b326578d67f7',
                'medicine_name' => 'Diazepam 5mg Tablet (VALISANBE)',
                'quantity' => 10,
                'unit_price' => 500,
                'dosage_frequency' => 1,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'malam sebelum tidur',
            ],
            [
                'id' => '702f4d3e-4e3d-446b-90fd-d9dfb738b602',
                'prescription_id' => '8b7c9e10-2d34-4f56-8a78-9b0c1d2e3f40',
                'medicine_id' => '9cf72984-02d4-4270-b659-708bae3c5ca1',
                'medicine_name' => 'Propranolol Hydrochloride 10mg Tablet (KIMIA FARMA)',
                'quantity' => 20,
                'unit_price' => 500,
                'dosage_frequency' => 2,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'sesudah makan',
            ],

            // Examination 2 - Influenza
            [
                'id' => '703f4d3e-4e3d-446b-90fd-d9dfb738b603',
                'prescription_id' => '9c0d1e21-3f45-4a67-9b89-0c1d2e3f4a51',
                'medicine_id' => '9cf72984-0015-45a4-a2b4-dcf83e8fe144',
                'medicine_name' => 'Paracetamol 500mg Tablet (SANMOL)',
                'quantity' => 15,
                'unit_price' => 500,
                'dosage_frequency' => 3,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'jika demam',
            ],
            [
                'id' => '704f4d3e-4e3d-446b-90fd-d9dfb738b604',
                'prescription_id' => '9c0d1e21-3f45-4a67-9b89-0c1d2e3f4a51',
                'medicine_id' => '9cf72984-0411-4b11-969c-e13a4b116bec',
                'medicine_name' => 'Mefenamic Acid 500mg Tablet Salut Selaput (MEFINAL 500)',
                'quantity' => 15,
                'unit_price' => 500,
                'dosage_frequency' => 3,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'sesudah makan',
            ],
            [
                'id' => '705f4d3e-4e3d-446b-90fd-d9dfb738b605',
                'prescription_id' => '9c0d1e21-3f45-4a67-9b89-0c1d2e3f4a51',
                'medicine_id' => '9cf72984-0622-4a2b-81e8-1b92fbbdeb64',
                'medicine_name' => 'Methylprednisolone 8mg Tablet (SANEXON 8)',
                'quantity' => 10,
                'unit_price' => 500,
                'dosage_frequency' => 1,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'pagi hari',
            ],

            // Examination 3 - Hipertensi
            [
                'id' => '706f4d3e-4e3d-446b-90fd-d9dfb738b606',
                'prescription_id' => 'ad2e3f32-4a56-4b78-8c9a-1d2e3f4a5b62',
                'medicine_id' => '9cf72984-02d4-4270-b659-708bae3c5ca1',
                'medicine_name' => 'Propranolol Hydrochloride 10mg Tablet (KIMIA FARMA)',
                'quantity' => 30,
                'unit_price' => 500,
                'dosage_frequency' => 2,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'pagi dan malam',
            ],

            // Examination 4 - Gastritis akut
            [
                'id' => '707f4d3e-4e3d-446b-90fd-d9dfb738b607',
                'prescription_id' => 'be3f4053-5b67-4c89-9dab-2e3f4a5b6c73',
                'medicine_id' => '9cf72984-0265-4a83-9eba-278eae10ca92',
                'medicine_name' => 'Ranitidine Hydrochloride 150mg Tablet Salut Selaput (HEXPHARM)',
                'quantity' => 14,
                'unit_price' => 500,
                'dosage_frequency' => 2,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'sebelum makan',
            ],
            [
                'id' => '708f4d3e-4e3d-446b-90fd-d9dfb738b608',
                'prescription_id' => 'be3f4053-5b67-4c89-9dab-2e3f4a5b6c73',
                'medicine_id' => '9cf72984-01ed-46fa-8efc-04ce10eae2ed',
                'medicine_name' => 'Esomeprazole Sodium 20mg Tablet (ESOFERR)',
                'quantity' => 14,
                'unit_price' => 500,
                'dosage_frequency' => 1,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'pagi sebelum makan',
            ],

            // Examination 5 - Overfatigue
            [
                'id' => '709f4d3e-4e3d-446b-90fd-d9dfb738b609',
                'prescription_id' => 'cf405164-6c78-4d9a-8ebc-3f4a5b6c7d84',
                'medicine_id' => '9cf72984-03a8-43ad-9a57-41b8c6f2ba27',
                'medicine_name' => 'Vitamin E/C/B1 (BECOM - ZET)',
                'quantity' => 20,
                'unit_price' => 500,
                'dosage_frequency' => 1,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'sesudah makan',
            ],
            [
                'id' => '70af4d3e-4e3d-446b-90fd-d9dfb738b60a',
                'prescription_id' => 'cf405164-6c78-4d9a-8ebc-3f4a5b6c7d84',
                'medicine_id' => '9cf72984-033d-4af8-95cb-2b4912602c8a',
                'medicine_name' => 'Mecobalamin 500 mg Tablet (LAPIBAL)',
                'quantity' => 20,
                'unit_price' => 500,
                'dosage_frequency' => 1,
                'dosage_amount' => 1,
                'dosage_unit' => 'tablet',
                'additional_instruction' => 'malam hari',
            ],
        ]);
    }
}

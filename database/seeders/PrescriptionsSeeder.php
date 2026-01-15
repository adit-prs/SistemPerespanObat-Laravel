<?php

namespace Database\Seeders;

use App\Models\prescriptions;
use Illuminate\Database\Seeder;

class PrescriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        prescriptions::insert([
            [
                'id' => '8b7c9e10-2d34-4f56-8a78-9b0c1d2e3f40',
                'examination_id' => '1c4a7366-7907-48c7-9aea-19e580b5b3db',
                'receipt_number' => 'RX-20260104-0001',
                'status' => 'diambil',
            ],
            [
                'id' => '9c0d1e21-3f45-4a67-9b89-0c1d2e3f4a51',
                'examination_id' => '2f7b9d44-2e5a-4e9b-8c1f-0ad3b2c4d5e6',
                'receipt_number' => 'RX-20260107-0001',
                'status' => 'dibatalkan',
            ],
            [
                'id' => 'ad2e3f32-4a56-4b78-8c9a-1d2e3f4a5b62',
                'examination_id' => '3a9c5b88-4f21-4d3e-9b7a-12c4e5f6a7b8',
                'receipt_number' => 'RX-20260109-0001',
                'status' => 'diambil',
            ],
            [
                'id' => 'be3f4053-5b67-4c89-9dab-2e3f4a5b6c73',
                'examination_id' => '4d2e7c11-6a3b-4f9c-8d2e-23b5c6d7e8f9',
                'receipt_number' => 'RX-20260111-0001',
                'status' => 'diambil',
            ],
            [
                'id' => 'cf405164-6c78-4d9a-8ebc-3f4a5b6c7d84',
                'examination_id' => '5e8f1a22-9b4c-4e1d-9f3a-34c6d7e8f9a0',
                'receipt_number' => 'RX-20260113-0001',
                'status' => 'dibatalkan',
            ],
        ]);
    }
}

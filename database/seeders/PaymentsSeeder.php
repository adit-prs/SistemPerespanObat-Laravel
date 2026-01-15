<?php

namespace Database\Seeders;

use App\Models\payments;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        payments::insert([
            [
                'id' => '7f2bb8e2-2a3c-4e2c-9c59-1a6f10fd2f11',
                'prescription_id' => '8b7c9e10-2d34-4f56-8a78-9b0c1d2e3f40',
                'amount_due' => 11200,
                'amount_paid' => 12000,
                'status' => 'lunas',
                'method' => 'tunai',
            ],
            [
                'id' => '2b6a0c1e-d713-4b4e-9e33-9be2d64df611',
                'prescription_id' => '9c0d1e21-3f45-4a67-9b89-0c1d2e3f4a51',
                'amount_due' => 100700,
                'amount_paid' => 0,
                'status' => 'dibatalkan',
                'method' => '-',
            ],
            [
                'id' => '80d68e98-39e3-49a4-9d20-74a73c14a411',
                'prescription_id' => 'ad2e3f32-4a56-4b78-8c9a-1d2e3f4a5b62',
                'amount_due' => 4080,
                'amount_paid' => 5000,
                'status' => 'lunas',
                'method' => 'tunai',
            ],
            [
                'id' => '4bfb2499-eb46-4deb-a3cd-5cc83ce864c1',
                'prescription_id' => 'be3f4053-5b67-4c89-9dab-2e3f4a5b6c73',
                'amount_due' => 226744,
                'amount_paid' => 226744,
                'status' => 'lunas',
                'method' => 'qris',
            ],
            [
                'id' => 'cfaf76ca-b778-4c44-9378-f52f0b2cb971',
                'prescription_id' => 'cf405164-6c78-4d9a-8ebc-3f4a5b6c7d84',
                'amount_due' => 162060,
                'amount_paid' => 0,
                'status' => 'dibatalkan',
                'method' => '-',
            ],
        ]);
    }
}

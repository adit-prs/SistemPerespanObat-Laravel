<?php

namespace Database\Seeders;

use App\Models\patients;
use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        patients::insert([
            [
                'id' => 'c4a2bcd9-6c46-4a74-9b63-29d0ed548621',
                'medical_record_number' => 'NP-000001',
                'name' => 'Ahmad Fauzi',
                'gender' => 'L',
                'birth_date' => '1990-05-12',
                'address' => 'Jl. Merdeka No. 12, Jakarta',
                'phone' => '081234567801',
            ],
            [
                'id' => '1c4a7366-7907-48c7-9aea-19e580b5b3db',
                'medical_record_number' => 'NP-000002',
                'name' => 'Siti Nurhaliza',
                'gender' => 'P',
                'birth_date' => '1987-09-23',
                'address' => 'Jl. Melati No. 45, Bandung',
                'phone' => '081234567802',
            ],
            [
                'id' => '7d93624b-26e6-46cf-a0a4-9bd871eebeca',
                'medical_record_number' => 'NP-000003',
                'name' => 'Budi Santoso',
                'gender' => 'L',
                'birth_date' => '1995-12-01',
                'address' => 'Jl. Kenanga No. 10, Surabaya',
                'phone' => '081234567803',
            ],
            [
                'id' => 'dc91e72c-1a6e-40fa-a016-4f52d0f581ab',
                'medical_record_number' => 'NP-000004',
                'name' => 'Dewi Kartika',
                'gender' => 'P',
                'birth_date' => '1992-03-30',
                'address' => 'Jl. Mawar No. 7, Yogyakarta',
                'phone' => '081234567804',
            ],
            [
                'id' => '8c6be962-65f9-4e94-9f40-a8cfd04d2698',
                'medical_record_number' => 'NP-000005',
                'name' => 'Rizky Ramadhan',
                'gender' => 'L',
                'birth_date' => '2000-01-15',
                'address' => 'Jl. Dahlia No. 2, Semarang',
                'phone' => '081234567805',
            ],
            [
                'id' => 'b6a06d8e-7e49-4c09-a155-51bdb2f2080a',
                'medical_record_number' => 'NP-000006',
                'name' => 'Nadia Ayu Lestari',
                'gender' => 'P',
                'birth_date' => '1998-07-08',
                'address' => 'Jl. Flamboyan No. 20, Medan',
                'phone' => '081234567806',
            ],
            [
                'id' => 'e36d5b32-7e53-4b7f-b1e9-46cce7aaafac',
                'medical_record_number' => 'NP-000007',
                'name' => 'Agus Pratama',
                'gender' => 'L',
                'birth_date' => '1985-11-11',
                'address' => 'Jl. Anggrek No. 15, Palembang',
                'phone' => '081234567807',
            ],
            [
                'id' => '59e77ca1-f407-4489-bf6a-13c29cc74eb3',
                'medical_record_number' => 'NP-000008',
                'name' => 'Lina Kusumawati',
                'gender' => 'P',
                'birth_date' => '1993-06-19',
                'address' => 'Jl. Sakura No. 8, Malang',
                'phone' => '081234567808',
            ],
            [
                'id' => '85d8ba3f-35bd-4cc6-9cd5-5c276bedfb91',
                'medical_record_number' => 'NP-000009',
                'name' => 'Fajar Setiawan',
                'gender' => 'L',
                'birth_date' => '1999-10-05',
                'address' => 'Jl. Teratai No. 4, Bekasi',
                'phone' => '081234567809',
            ],
            [
                'id' => 'b4afde23-4079-43d3-995e-f47c6d8439cb',
                'medical_record_number' => 'NP-000010',
                'name' => 'Citra Novita',
                'gender' => 'P',
                'birth_date' => '1989-02-25',
                'address' => 'Jl. Cendana No. 3, Depok',
                'phone' => '081234567810',
            ],
        ]);
    }
}

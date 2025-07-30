<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 'dceffa92-b61f-4c20-87f7-e8f034f7cc87',
            'name' => 'John Doe',
            'email' => 'john.doe@email.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);
    }
}

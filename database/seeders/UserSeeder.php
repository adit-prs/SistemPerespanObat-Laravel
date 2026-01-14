<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
                [
                    'id' => 'dceffa92-b61f-4c20-87f7-e8f034f7cc87',
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'dokter',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => '9e5c699e-0744-4d72-9a9c-7c2e6a2c3d43',
                    'name' => 'Sarah Johnson',
                    'email' => 'sarah@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'dokter',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 'e838b2a4-c7bd-4c38-99cd-8dd8f3d2d6e1',
                    'name' => 'David Miller',
                    'email' => 'david@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'apoteker',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 'bcdaf95e-85c2-4b97-84b9-3df8da8dfa47',
                    'name' => 'Laura Smith',
                    'email' => 'laura@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'apoteker',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 'eddbc1e3-5c7b-43ff-a68d-fb597b534a26',
                    'name' => 'Robert Wilson',
                    'email' => 'robert@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}

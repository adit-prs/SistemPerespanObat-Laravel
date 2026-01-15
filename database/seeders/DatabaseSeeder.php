<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $this->call(UserSeeder::class);
        $this->call(PatientsSeeder::class);
        $this->call(ExaminationsSeeder::class);
        $this->call(PrescriptionsSeeder::class);
        $this->call(PrescriptionItemsSeeder::class);
        $this->call(PaymentsSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call your seeders here
        $this->call([
            VaccineCenterSeeder::class,
            // Add other seeders as needed
        ]);
    }
}

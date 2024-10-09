<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineCenterSeeder extends Seeder
{
    public function run()
    {
        DB::table('vaccine_centers')->insert([
            ['name' => 'Center A', 'location' => 'Dhaka', 'daily_limit' => 100],
            ['name' => 'Center B', 'location' => 'Dhaka', 'daily_limit' => 150],
            ['name' => 'Center C', 'location' => 'Dhaka', 'daily_limit' => 200],
            ['name' => 'Center D', 'location' => 'Dhaka', 'daily_limit' => 50],
            ['name' => 'Center E', 'location' => 'Dhaka', 'daily_limit' => 75],
            ['name' => 'Center F', 'location' => 'Dhaka', 'daily_limit' => 100],
            ['name' => 'Center G', 'location' => 'Dhaka', 'daily_limit' => 100],
            ['name' => 'Center H', 'location' => 'Dhaka', 'daily_limit' => 100],
            ['name' => 'Center I', 'location' => 'Dhaka', 'daily_limit' => 100],
            ['name' => 'Center J', 'location' => 'Dhaka', 'daily_limit' => 100],

            // Add more centers as needed
        ]);
    }
}

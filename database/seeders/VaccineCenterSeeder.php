<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineCenterSeeder extends Seeder
{
    public function run()
    {
        DB::table('vaccine_centers')->insert([
            ['name' => 'Center A', 'daily_limit' => 100],
            ['name' => 'Center B', 'daily_limit' => 150],
            ['name' => 'Center C', 'daily_limit' => 200],
            // Add more centers as needed
        ]);
    }
}

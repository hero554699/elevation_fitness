<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'branch_name' => 'Sta. Ana Branch',
                'location'    => 'Sta. Ana Avenue, Davao City',
                'maps_url'    => 'https://maps.google.com/?q=Elevation+Fitness+Gym+Sta+Ana+Davao+City',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'branch_name' => 'Buhangin Branch',
                'location'    => 'Buhangin, Davao City',
                'maps_url'    => 'https://maps.google.com/?q=Elevation+Fitness+Gym+Buhangin+Davao+City',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'branch_name' => 'Ecoland Branch',
                'location'    => 'Quimpo Boulevard, Ecoland, Davao City',
                'maps_url'    => 'https://maps.google.com/?q=Elevation+Fitness+Gym+Ecoland+Davao+City',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'branch_name' => 'Lanang Branch',
                'location'    => 'Lanang, Davao City',
                'maps_url'    => 'https://maps.google.com/?q=Elevation+Fitness+Gym+Lanang+Davao+City',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'branch_name' => 'Panabo Branch',
                'location'    => 'Panabo City',
                'maps_url'    => 'https://maps.google.com/?q=Elevation+Fitness+Gym+Panabo+City',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'branch_name' => 'Tagum Branch',
                'location'    => 'Tagum City',
                'maps_url'    => 'https://maps.google.com/?q=Elevation+Fitness+Gym+Tagum+City',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipPlanSeeder extends Seeder
{
    // Inserts the 5 membership plans into the database
    // Run with: php artisan db:seed --class=MembershipPlanSeeder
    public function run(): void
    {
        DB::table('membership_plans')->insert([
            [
                'plan_name'     => '1-Day Pass',
                'duration_days' => 1,
                'price'         => 150.00,
                'description'   => 'Experience our gym with a convenient 1-day pass.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'plan_name'     => '1-Month Plan',
                'duration_days' => 30,
                'price'         => 1000.00,
                'description'   => 'Enjoy the flexibility of a month-to-month membership.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'plan_name'     => '3-Month Plan',
                'duration_days' => 90,
                'price'         => 2700.00,
                'description'   => 'Elevate your fitness game with our popular 3-month membership.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'plan_name'     => '6-Month Plan',
                'duration_days' => 180,
                'price'         => 4500.00,
                'description'   => 'Take your commitment to the next level with a 6-month subscription.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'plan_name'     => '1-Year Plan',
                'duration_days' => 365,
                'price'         => 6500.00,
                'description'   => 'Maximize your gains with our 1-year subscription.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
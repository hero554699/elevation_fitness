<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'      => 'Super Admin',
            'email'     => 'superadmin@elevation.com',
            'password'  => Hash::make('superadmin123'),
            'role'      => 'super_admin',
            'branch_id' => null,
        ]);

        $branches = [
            1 => ['name' => 'Sta. Ana Admin',  'email' => 'staana@elevation.com'],
            2 => ['name' => 'Buhangin Admin',  'email' => 'buhangin@elevation.com'],
            3 => ['name' => 'Ecoland Admin',   'email' => 'ecoland@elevation.com'],
            4 => ['name' => 'Lanang Admin',    'email' => 'lanang@elevation.com'],
            5 => ['name' => 'Panabo Admin',    'email' => 'panabo@elevation.com'],
            6 => ['name' => 'Tagum Admin',     'email' => 'tagum@elevation.com'],
        ];

        foreach ($branches as $branchId => $data) {
            User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => Hash::make('branch123'),
                'role'      => 'branch_admin',
                'branch_id' => $branchId,
            ]);
        }
    }
}
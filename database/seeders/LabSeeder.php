<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lab;

class LabSeeder extends Seeder
{
    public function run()
    {
        Lab::create([
            'name' => 'Computer Lab A',
            'building' => 'Science Building',
            'lab_status' => true,
        ]);

        Lab::create([
            'name' => 'Computer Lab B',
            'building' => 'Engineering Building',
            'lab_status' => true,
        ]);

        Lab::create([
            'name' => 'Computer Lab C',
            'building' => 'Library',
            'lab_status' => true,
        ]);
    }
}

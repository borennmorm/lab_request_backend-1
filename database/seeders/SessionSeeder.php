<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Session;

class SessionSeeder extends Seeder
{
    public function run()
    {
        $sessions = [
            ['name' => '07:00 - 08:30', 'number' => '1'],
            ['name' => '08:40 - 10:20', 'number' => '2'],
            ['name' => '10:30 - 12:00', 'number' => '3'],
            ['name' => '13:00 - 14:30', 'number' => '4'],
            ['name' => '14:40 - 16:10', 'number' => '5'],
            ['name' => '16:20 - 17:00', 'number' => '6'],
        ];

        foreach ($sessions as $session) {
            Session::create($session);
        }
    }
}

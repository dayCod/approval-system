<?php

namespace Database\Seeders;

use App\Models\Consent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'name' => 'Izin Melahirkan',
            'created_at' => now()
        ], ['name' => 'Izin Rawat Inap', 'created_at' => now()]
        , ['name' => 'Izin Bencana Alam', 'created_at' => now()]];

        Consent::insert($data);

    }
}

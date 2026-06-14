<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    public function run()
    {
        DB::table('packages')->insert([
            [
                'name' => 'Paket 7 Hari',
                'duration_days' => 7,
                'price' => 59000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket 30 Hari',
                'duration_days' => 30,
                'price' => 199000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

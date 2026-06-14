<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    public function run(): void
    {
        Venue::create([
            'nama_venue' => 'Stadion Mandala Krida',
            'lokasi' => 'Yogyakarta',
            'kapasitas' => 20000,
        ]);

        Venue::create([
            'nama_venue' => 'JCC Senayan',
            'lokasi' => 'Jakarta',
            'kapasitas' => 5000,
        ]);
    }
}

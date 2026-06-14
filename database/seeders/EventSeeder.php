<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User; // pastikan ada user sebagai EO

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // EO pertama (pastikan user ada)

Event::create([
    'user_id' => $user->id,
    'title' => 'Konser Musik Rock',
    'description' => 'Konser rock terbesar tahun ini!',
    'event_date' => '2025-08-01 19:00:00',
    'location' => 'Stadion Mandala Krida, Yogyakarta',
    'capacity' => 5000,
    'price' => 150000.00,
    'image' => 'image.jpg',
]);
    }
}

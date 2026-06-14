<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        Artist::create([
            'nama_artist' => 'The Rolling Stones',
            'genre' => 'Rock',
            'deskripsi' => 'Band rock legendaris dari Inggris.',
        ]);

        Artist::create([
            'nama_artist' => 'Adele',
            'genre' => 'Pop',
            'deskripsi' => 'Penyanyi dan penulis lagu asal Inggris.',
        ]);
    }
}

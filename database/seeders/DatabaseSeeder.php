<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VenueSeeder::class,
            ArtistSeeder::class,
            EventSeeder::class,
            EventArtistSeeder::class,
            PackageSeeder::class,
        ]);


    }
}

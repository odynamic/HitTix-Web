<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'image' => null, // Bisa kamu ganti dengan file dummy di storage
            'category_id' => null, // Bisa assign jika ada kategori
            'venue' => $this->faker->city(),
            'price' => $this->faker->randomFloat(2, 10, 100), // harga antara 10 sampai 100
        ];
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Movie\Actor;
use App\Models\Movie\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $actors = Actor::factory()->count(10)->create();

        // Створюємо 100 фільмів і зв'язуємо їх з акторами
        Movie::factory()->count(100)->create()->each(function ($movie) use ($actors) {
            // Випадково вибираємо акторів для кожного фільму
            $randomActors = $actors->random(rand(1, 5)); // Вибираємо від 1 до 5 акторів

            // Додаємо акторів до фільму
            $movie->actors()->attach($randomActors->pluck('id')->toArray());
        });
    }
}

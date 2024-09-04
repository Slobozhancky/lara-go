<?php

namespace Database\Factories\Movie;

use App\Models\Movie\Actor;
use App\Models\Movie\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ActorMovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => $this->faker->numberBetween(1, 100),
            'actor_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}

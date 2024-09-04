<?php

namespace Database\Factories\Movie;

use App\Models\Movie\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Actor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'bio' => $this->faker->sentence()
        ];
    }
}

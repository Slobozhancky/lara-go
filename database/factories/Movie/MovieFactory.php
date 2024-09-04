<?php

namespace Database\Factories\Movie;

use App\Models\Movie\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Movie::class;

    public function definition(): array
    {

        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(),
            'rate' => $this->faker->randomFloat(1, 1, 10),
        ];
    }
}

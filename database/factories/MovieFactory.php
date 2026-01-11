<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Define fake data to use it in the seeder
            'title' => $this->faker->sentence(3), // 3 words title
            'status' => $this->faker->randomElement(['To watch', 'Finished']),
            'rating' => $this->faker->numberBetween(1,5),
        ];
    }
}

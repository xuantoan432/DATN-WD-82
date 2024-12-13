<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => rand(1,30),
            'user_id' => \App\Models\User::factory(),
            'content' => $this->faker->sentence(),
            'star' => $this->faker->numberBetween(1, 5),
            'image' => $this->faker->optional()->imageUrl(640, 480, 'reviews', true),
            'parent_id' => 0,
        ];
    }
}

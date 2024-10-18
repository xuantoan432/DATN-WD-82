<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text(2000),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'posts', true),
            'views' => $this->faker->numberBetween(0, 10000),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

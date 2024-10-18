<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'banner_title' => $this->faker->sentence,
            'banner_image' => $this->faker->imageUrl(1200, 300, 'business', true, 'banner'),
            'banner_text' => $this->faker->sentence,
            'banner_link' => $this->faker->url,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'seller_id' => rand(1, 10),
            'quantity' => $this->faker->numberBetween(1, 10),
            'product_variant_id' => rand(1,30),
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->randomElement(['Pending', 'Processing', 'Shipping', 'Delivered', 'Cancelled']),
            'variant_name' => $this->faker->word,
        ];
    }
}

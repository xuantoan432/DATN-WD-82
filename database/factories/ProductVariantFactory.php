<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'sku' => $this->faker->unique()->bothify('VAR-####'),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'price_sale' => $this->faker->optional()->randomFloat(2, 5, 800),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'date_start' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'date_end' => $this->faker->optional()->dateTimeBetween('+1 month', '+6 months'),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}

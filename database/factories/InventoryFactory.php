<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_variant_attribute_id' => \App\Models\ProductVariantAttribute::factory(),
            'product_id' => \App\Models\Product::factory(),
            'seller_id' => \App\Models\User::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}

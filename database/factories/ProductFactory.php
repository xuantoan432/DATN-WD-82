<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'seller_id' => Seller::factory(),
            'final_fee_percentage' => $this->faker->randomFloat(2, 0, 100),
            'name' => $this->faker->words(3, true),
            'short_description' => $this->faker->sentence,
            'sku' => $this->faker->unique()->numerify('SKU-#####'),
            'content' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 10, 1000),

            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'views' => $this->faker->numberBetween(0, 1000),

            'is_verified' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['active', 'inactive', 'pending']),
        ];
    }
}

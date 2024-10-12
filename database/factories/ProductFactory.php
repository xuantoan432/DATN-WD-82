<?php

namespace Database\Factories;

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
            'category_id',
            'saller_id',
            'final_fee_percentage',
            'name',
            'short_description',
            'sku',
            'content',
            'price',
            'price_sale',
            'image',
            'views',
            'quantity',
            'is_verified',
            'status'
        ];
    }
}

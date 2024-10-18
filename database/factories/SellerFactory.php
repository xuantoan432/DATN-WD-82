<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'store_name' => $this->faker->unique()->company(),
            'store_email' => $this->faker->unique()->companyEmail(),
            'store_description' => $this->faker->paragraph(),
            'account_balance' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}

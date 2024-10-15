<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
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
            'code' =>strtoupper($this->faker->unique()->lexify('VOUCHER-???')),
            'discount_type' => $this->faker->randomElement(['percentage', 'fixed']),
            'discount_value' => $this->faker->numberBetween(1, 100),
            'max_discount_amount' => $this->faker->numberBetween(10, 500),
            'min_order_value' => $this->faker->numberBetween(50, 100),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'usage_limit' => $this->faker->numberBetween(1, 100),
            'usage_type' => $this->faker->randomElement([false, true]),
            'usage_per_customer' => $this->faker->numberBetween(1, 5),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_status_id' => \App\Models\PaymentStatus::factory(),
            'payment_method_id' => \App\Models\PaymentMethod::factory(),
            'order_code' => $this->faker->unique()->bothify('ORDER-#####'),
            'order_status_id' => \App\Models\OrderStatus::factory(),
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
            'shipping_address' => $this->faker->address,
            'note' => $this->faker->sentence,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

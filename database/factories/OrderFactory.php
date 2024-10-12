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
            'payment_status_id',
            'payment_method_id',
            'order_code',
            'order_status_id',
            'total_price',
            'shipping_address',
            'note',
            'user_id'
        ];
    }
}

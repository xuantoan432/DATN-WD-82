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
            'created_by',
            'code',
            'discount_type',
            'discount_value',
            'max_discount_amount',
            'min_order_value',
            'start_date',
            'end_date',
            'usage_limit',
            'usage_type',
            'usage_per_customer',
        ];
    }
}

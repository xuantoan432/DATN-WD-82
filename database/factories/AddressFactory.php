<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_line' => fake()->address(),
            'ward_id' => rand(1, 10),
            'province_id' => rand(1, 10),
            'district_id' => rand(1, 10),
        ];
    }
}

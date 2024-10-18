<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'message' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'sent', 'read']),
            'receiver_type' => $this->faker->randomElement(['saller', 'admin']),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

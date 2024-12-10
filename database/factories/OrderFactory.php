<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'total_price' => $this->faker->randomFloat(2, 10, 500), // Random price between $10 and $500
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
        ];
    }
}

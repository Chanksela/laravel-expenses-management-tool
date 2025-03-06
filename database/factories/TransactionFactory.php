<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "description" => fake()->sentence(),
            "amount" => fake()->randomFloat(2, 1, 1000),
            "date" => fake()->date(),
            "category_id" => Category::inRandomOrder()->first()->id,
            "user_id" => User::factory()->create()->id,
            "transaction_type" => $this->faker->randomElement([1, 2]),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}

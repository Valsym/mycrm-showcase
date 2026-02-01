<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'company_id' => rand(1, 10),
            'status_id' => rand(1, 4),
            'contact_id' => rand(1, 10),
            'executor_id' => rand(1, 5),
            'user_id' => rand(1, 5),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'description' => $this->faker->paragraph(2),
            'budget_amount' => $this->faker->numberBetween(5000, 500000),
        ];
    }
}

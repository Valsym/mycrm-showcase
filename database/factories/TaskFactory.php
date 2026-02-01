<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->text(150),
            //            'user_id' => rand(1, 5),
            'executor_id' => rand(1, 10),
            'deal_id' => rand(1, 20),
            'due_date' => $this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'type_id' => rand(1, 5),
            'created_at' => $this->faker->dateTimeBetween('now', '+1 months')->format('Y-m-d'),
        ];
    }
}

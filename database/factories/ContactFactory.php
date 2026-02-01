<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => substr($this->faker->e164PhoneNumber, 1, 11),
            'position' => $this->faker->jobTitle,
            'type_id' => rand(1, 3),
            'company_id' => rand(1, 10),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'province_id' => 35,
            'regency_id' => 3578,
            'district_id' => 3578080,
            'village_id' => fake()->numberBetween(3578080001, 3578080007),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bid>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Generates a user for each bid or link to an existing user
            'status_active' => $this->faker->boolean(),
            'project_name' => $this->faker->word . ' Project',
            'project_sqft' => $this->faker->randomFloat(2, 50, 5000),
            'client_first_name' => $this->faker->firstName(),
            'client_last_name' => $this->faker->lastName(),
            'client_company' => $this->faker->company(),
            'client_email' => $this->faker->email(),
            'client_phone' => $this->faker->phoneNumber(),
            'general_conditions_percent' => $this->faker->randomFloat(2, 0, 1),
            'overhead_profit_percent' => $this->faker->randomFloat(2, 0, 1),
            'tax_exempt' => $this->faker->boolean(),
            'tax_percent' => $this->faker->randomFloat(2, 0, 0.15),
            'labor_days' => $this->faker->randomFloat(0, 1, 365),
            'labor_unit_cost' => $this->faker->randomFloat(2, 0, 100),
            'grand_total' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}

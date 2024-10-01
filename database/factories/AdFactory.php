<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker-> sentence(3),
            'user_id'=>User::inRandomOrder()->first()->id,
            'description' => $this->faker->paragraph(10),
            'price' => $this->faker->randomFloat(2, 0, 4999.99),
            'active' => $this->faker->boolean(50),
            'priority' => $this->faker->boolean(50),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::inRandomOrder();
        return [
            'sender_id' => $users->first()->id,
            'receiver_id' => $users->first()->id + 1,
            'body' => $this->faker->paragraph(3),
        ];
    }
}

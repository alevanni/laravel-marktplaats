<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ad;

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
        $ad = Ad::inRandomOrder()->first();
        $price = $ad->price;

        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'ad_id'=> $ad->id,
            'amount'=> $price + mt_rand(0, 5000),
            
        ];
    }
}

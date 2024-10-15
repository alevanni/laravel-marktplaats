<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['full_name' => 'Test Example', 'password' => bcrypt('password'), 'email' => 'test@example.nl', 'email_verified_at' => now(), 'enable_notifications'=> 1, 'remember_token' => Str::random(10)]);

        User::factory()->count(15)->create();

    }
}

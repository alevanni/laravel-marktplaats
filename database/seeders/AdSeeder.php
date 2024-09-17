<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ad;
use App\Models\Category;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = Category::all();

       $ads = Ad::factory()->count(20)->create();

       $ads->each( function ($article) use ($categories) {
          $article->categories()->attach(
            $categories->random(rand(0, 3))->pluck('id')->toArray()
          );
       }

       );
    }
}

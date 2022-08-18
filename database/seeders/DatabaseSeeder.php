<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory(10)->create();
        $categories = ['Cele News', 'Sport News', "IT News", "Car News"];
        foreach($categories as $category) {
            Category::factory()->create([
                "title" => $category,
                "slug" => Str::slug($category),
                "user_id" => User::inRandomOrder()->first()->id
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        User::factory(10)->create();
        User::factory()->create([
            "name" => "admin",
            "email" => "admin@example.com",
            "password" => Hash::make("asdffdsa")
        ]);

        $categories = ['Cele News', 'Sport News', "IT News", "Car News"];
        foreach($categories as $category) {
            Category::factory()->create([
                "title" => $category,
                "slug" => Str::slug($category),
                "user_id" => User::inRandomOrder()->first()->id
            ]);
        }

        \App\Models\Post::factory(250)->create();
    }
}

<?php

namespace Database\Seeders;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\CategorySeeder;
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
        $this->call([

            CategorySeeder::class,
            PostSeeder::class

        ]);
    }
}

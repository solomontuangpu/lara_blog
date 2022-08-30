<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        User::factory()->create([
            "name" => "admin",
            "email" => "admin@example.com",
            "role" => "admin",
            "password" => Hash::make("asdffdsa")
        ]);
        User::factory()->create([
            "name" => "editor",
            "email" => "editor@example.com",
            "role" => "editor",
            "password" => Hash::make("asdffdsa")
        ]);
        User::factory()->create([
            "name" => "author",
            "email" => "author@example.com",
            "role" => "author",
            "password" => Hash::make("asdffdsa")
        ]);
    }
}

<?php

namespace Database\Seeders;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\NationSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        $this->call([
            // NationSeeder::class,
            // UserSeeder::class,
            // CategorySeeder::class,
            PostSeeder::class

        ]);
        // $photos = Storage::allFiles('public');
        // array_shift($photos);
        // Storage::delete($photos);
        // echo "Storage Cleaned \n";
    }
}

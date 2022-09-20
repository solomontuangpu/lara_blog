<?php

namespace Database\Seeders;

use App\Models\Nation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ["Myanmar", "Singapore", "Japan", "Thailand", "Korea"];
        foreach($countries as $country) {
           Nation::factory()->create([
                "name" => $country
           ]);
        };
    }
}

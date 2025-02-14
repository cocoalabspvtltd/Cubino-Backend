<?php

namespace Database\Seeders;

use App\Models\PopularCity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopilarCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Kolkata', 'image' => 'popular-cities/Kolkata.jpg'],
            ['name' => 'Mumbai', 'image' => 'popular-cities/Mumbai.jpg'],
            ['name' => 'Bengaluru', 'image' => 'popular-cities/Bengaluru.jpg'],
            ['name' => 'Chennai', 'image' => 'popular-cities/Chennai.jpg'],
            ['name' => 'Hyderabad', 'image' => 'popular-cities/Hyderabad.jpg'],
            ['name' => 'Agra', 'image' => 'popular-cities/Agra.jpg'],
            ['name' => 'Jaipur', 'image' => 'popular-cities/Jaipur.jpg']

        ];

        // Insert states into database
        foreach ($cities as $city) {
            PopularCity::create($city);
        }
    }
}

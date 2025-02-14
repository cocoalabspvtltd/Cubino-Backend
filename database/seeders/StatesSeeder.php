<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Andhra Pradesh', 'image' => 'states/andhra_pradesh.jpg'],
            ['name' => 'Arunachal Pradesh', 'image' => 'states/arunachal_pradesh.jpg'],
            ['name' => 'Assam', 'image' => 'states/assam.jpg'],
            ['name' => 'Bihar', 'image' => 'states/bihar.jpg'],
            ['name' => 'Chhattisgarh', 'image' => 'states/chhattisgarh.jpg'],
            ['name' => 'Goa', 'image' => 'states/goa.jpg'],
            ['name' => 'Gujarat', 'image' => 'states/gujarat.jpg'],
            ['name' => 'Haryana', 'image' => 'states/haryana.jpg'],
            ['name' => 'Himachal Pradesh', 'image' => 'states/himachal_pradesh.jpg'],
            ['name' => 'Jharkhand', 'image' => 'states/jharkhand.jpg'],
            ['name' => 'Karnataka', 'image' => 'states/karnataka.jpg'],
            ['name' => 'Kerala', 'image' => 'states/kerala.jpg'],
            ['name' => 'Madhya Pradesh', 'image' => 'states/madhya_pradesh.jpg'],
            ['name' => 'Maharashtra', 'image' => 'states/maharashtra.jpg'],
            ['name' => 'Manipur', 'image' => 'states/manipur.jpg'],
            ['name' => 'Meghalaya', 'image' => 'states/meghalaya.jpg'],
            ['name' => 'Mizoram', 'image' => 'states/mizoram.jpg'],
            ['name' => 'Nagaland', 'image' => 'states/nagaland.jpg'],
            ['name' => 'Odisha', 'image' => 'states/odisha.jpg'],
            ['name' => 'Punjab', 'image' => 'states/punjab.jpg'],
            ['name' => 'Rajasthan', 'image' => 'states/rajasthan.jpg'],
            ['name' => 'Sikkim', 'image' => 'states/sikkim.jpg'],
            ['name' => 'Tamil Nadu', 'image' => 'states/tamil_nadu.jpg'],
            ['name' => 'Telangana', 'image' => 'states/telangana.jpg'],
            ['name' => 'Tripura', 'image' => 'states/tripura.jpg'],
            ['name' => 'Uttar Pradesh', 'image' => 'states/uttar_pradesh.jpg'],
            ['name' => 'Uttarakhand', 'image' => 'states/uttarakhand.jpg'],
            ['name' => 'West Bengal', 'image' => 'states/west_bengal.jpg'],

            // Union Territories
            ['name' => 'Andaman and Nicobar Islands', 'image' => 'states/andaman_nicobar.jpg'],
            ['name' => 'Chandigarh', 'image' => 'states/chandigarh.jpg'],
            ['name' => 'Dadra and Nagar Haveli and Daman and Diu', 'image' => 'states/dadra_daman.jpg'],
            ['name' => 'Lakshadweep', 'image' => 'states/lakshadweep.jpg'],
            ['name' => 'Delhi', 'image' => 'states/delhi.jpg'],
            ['name' => 'Puducherry', 'image' => 'states/puducherry.jpg'],
            ['name' => 'Ladakh', 'image' => 'states/ladakh.jpg'],
            ['name' => 'Jammu and Kashmir', 'image' => 'states/jammu_kashmir.jpg'],
        ];

        // Insert states into database
        foreach ($states as $state) {
            State::create($state);
        }
    }
}

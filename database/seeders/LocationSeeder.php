<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Default Location
        $locations = [
            "Area KPA/SCC",
            "Tower 1",
            "Gor Bulutangkis",
            "Kolam 8",
            "RC",
            "STP",
            "Jalan ITS",
            "Gedung Alumni",
            "Gedung Rektorat"
        ];

        foreach ($locations as $location) {
            \App\Models\Location::create([
                'name' => $location
            ]);
        }

    }
}

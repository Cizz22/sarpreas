<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_unit = [
            [
                "name" => "Kebersihan"
            ],
            [
                "name" => "SKK Patroli"
            ],
            [
                "name" => "SKK Pos"
            ],
            [
                "name" => "SKK Gedung"
            ]
        ];

        foreach ($default_unit as $unit) {
            Unit::create($unit);
        }
    }
}

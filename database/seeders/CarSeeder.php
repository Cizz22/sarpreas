<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 7; $i++) {
            //Create Car
            // 'name',
            // 'vehicle_type',
            // 'capacity',
            // 'image',
            // 'description',
            Car::create([
                'name' => 'Car' . $i,
                'vehicle_type' => 'Car',
                'capacity' => 4,
                'image' => 'https://generatorfun.com/code/uploads/Random-Car-image-10.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
            ]);

        }
    }
}

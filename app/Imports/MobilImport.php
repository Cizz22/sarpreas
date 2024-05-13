<?php

namespace App\Imports;

use App\Models\Car;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MobilImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        $name_index = 2;

        foreach ($rows as $index => $row) {
            //Skip index 0 -> 3
            if ($index < 4) {
                continue;
            }

            if ($row[$name_index] == null) {
                continue;
            }

            Car::create([
                'name' => $row[$name_index],
                'vehicle_type' => 'Mobil',
                'capacity' => 6,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
            ]);
        }
    }
}

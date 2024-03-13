<?php

namespace App\Imports\Subunit;

use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OutdoorImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $name_index = 5;
        $subunit_index = 2;
        $unit_id = Unit::where('name', 'Kebersihan Indoor')->first()->id;
    }
}

<?php

namespace Database\Seeders;

use App\Imports\SubunitMemberImport;
use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $import = new SubunitMemberImport();
        $import->onlySheets('Mobil');

        Excel::import($import, public_path('data/data.xlsx'));
    }
}

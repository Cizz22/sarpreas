<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubunitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Subunit kebersihan
        \App\Models\Subunit::create([
            'name' => 'Rektorat',
            'unit_id' => 1,
            'coordinator_id' => 1,
        ]);
    }
}

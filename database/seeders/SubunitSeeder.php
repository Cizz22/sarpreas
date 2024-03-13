<?php

namespace Database\Seeders;

use App\Imports\SubunitMemberImport;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class SubunitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $import = new SubunitMemberImport();
        $import->onlySheets('Member Subunit Indoor', 'SKK');

        Excel::import($import, public_path('data/data.xlsx'));

        // //Create Subunit kebersihan Indoor // Prod
        // $kebersihan_indoor_id = Unit::where('name', 'Kebersihan Indoor')->first()->id;
        // $subunit_1 = [
        //     'Graha',
        //     'Rektorat',
        //     'FKK, Pascasarjana',
        //     'KPA, Biro Sarpras',
        //     'Teater ABC, SCC, Fasor',
        //     'Tower 1',
        //     'Tower 2',
        //     'Research Center',
        //     'Robotika, Forensik, STP, Nasdec, Lab Energi'
        // ];

        // $coodinators_1 = [
        //     'Supriyadi',
        //     'Bayu Sudiyono',
        //     'Zainal Arifin',
        //     'Reny Mey Susanti',
        //     'Sumandar',
        //     'Sri Utari',
        //     'Supervisor Junior Ferdian Sujalma',
        //     'Budi Prayitno',
        //     'Khoiruddin Effendi'
        // ];

        // foreach ($subunit_1 as $index => $name) {
        //     $coordinator = \App\Models\User::create([
        //         'name' => $coodinators_1[$index],
        //         'email' => 'coordinator' . $index . '@example.com',
        //         'roles' => 'coordinator',
        //         'password' => bcrypt("passwordcoor$index"),
        //         'email_verified_at' => now(),
        //     ]);

        //     \App\Models\Subunit::create([
        //         'name' => 'Subunit ' . $index + 1,
        //         'detail_location' => $name,
        //         'unit_id' => $kebersihan_indoor_id,
        //         'coordinator_id' => $coordinator->id
        //     ]);
        // }

        // //Kebersihan Outdoor
        // $kebersihan_outdoor_id = Unit::where('name', 'Kebersihan Outdoor')->first()->id;
        // $subunit_2 = [
        //     'Area Graha Sampai Bundaran Gor',
        //     'Graha, Bundaran Air Mancur, Taman Alumni, Taman Segitiga, Bundaran, Belakang Masjid',
        //     'Rektorat, Mainspin, FKK, Perpustakaan',
        //     'Parkir dan Halaman KPA, DKG, Teater A, Kantin, Sains, Parkir Tingkat, Fasor, Jalan Kembar Ika',
        //     'Area Pos 2 Sampai STP',
        //     'Jembatan Bosem Sampai Blok U, Blok U sampai Vivat, Vivat Sampai Tikungan Perkapalan',
        //     'Pos 2 Bundaran Gor, Depan K\'Mart, Tower 2, Bosem Blok U',
        //     'Depan RC Sampai STP, Samping Perkapalan Sampai Perpustakaan'
        // ];

        // $coodinators_2 = [
        //     'Supriyadi',
        //     'Bayu Sudiyono',
        //     'Zainal Arifin',
        //     'Reny Mey Susanti',
        //     'Sumandar',
        //     'Sri Utari',
        //     'Supervisor Junior Ferdian Sujalma',
        //     'Budi Prayitno',
        //     'Khoiruddin Effendi'
        // ];

        // foreach ($subunit_2 as $index => $name) {
        //     $coordinator = \App\Models\User::create([
        //         'name' => $coodinators_2[$index],
        //         'email' => 'coordinator' . $index . '@example.com',
        //         'roles' => 'coordinator',
        //         'password' => bcrypt("passwordcoor$index"),
        //         'email_verified_at' => now(),
        //     ]);

        //     \App\Models\Subunit::create([
        //         'name' => 'Subunit ' . $index + 1,
        //         'detail_location' => $name,
        //         'unit_id' => $kebersihan_outdoor_id,
        //         'coordinator_id' => $coordinator->id
        //     ]);
        // }

    }
}

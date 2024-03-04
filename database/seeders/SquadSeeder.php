<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SquadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seeder that make 4 squad, A B C D

        $squads = [
            ['A', ['Siang', 'Siang', 'Pagi', 'Pagi', 'Libur', 'Libur', 'Malam', 'Malam']],
            ['B', ['Pagi', 'Pagi', 'Libur', 'Libur', 'Malam', 'Malam', 'Siang', 'Siang']],
            ['C', ['Libur', 'Libur', 'Malam', 'Malam', 'Siang', 'Siang', 'Pagi', 'Pagi']],
            ['D', ['Malam', 'Malam', 'Siang', 'Siang', 'Pagi', 'Pagi', 'Libur', 'Libur']],
            ['Merah', ['Siang', 'Siang', 'Siang', 'Siang', 'Siang', 'Libur', 'Libur', 'Pagi', 'Pagi', 'Pagi', 'Pagi', 'Pagi', 'Libur', 'Libur']],
            ['Putih', ['Pagi', 'Pagi', 'Pagi', 'Pagi', 'Pagi', 'Libur', 'Libur', 'Siang', 'Siang', 'Siang', 'Siang', 'Siang', 'Libur', 'Libur']]
        ];

        for ($i = 0; $i < 6; $i++) {
            //Create Account for each squad
            $squad = User::create([
                'name' => $squads[$i][0] . '_Gedung',
                'email' => $squads[$i][0] . '_Gedung' . '@gmail.com',
                'password' => bcrypt('password'),
                'roles' => 'squad',
                'email_verified_at' => now(),
            ]);

            \App\Models\Squad::create([
                'name' => $squads[$i][0],
                'user_id' => $squad->id,
            ]);

            \App\Models\Passcode::generatePasscode($squad->id);
        }
    }
}

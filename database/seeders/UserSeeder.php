<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Admin user
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'roles' => 'admin',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);

        //coordinator
        for ($i = 1; $i <= 10; $i++) {
            //Create Coordinator user
            $coordinator =  \App\Models\User::create([
                'name' => 'Coordinator' . $i,
                'email' => 'coordinator' . $i . '@gmail.com',
                'roles' => 'coordinator',
                'password' => bcrypt("passwordcoor$i"),
                'email_verified_at' => now(),
            ]);

            \App\Models\Member::create([
                'name' => 'Coordinator' . $i,
                'no_hp' => '0812345678' . $i,
                'user_id' => $coordinator->id
            ]);


            \App\Models\Passcode::generatePasscode($coordinator->id);
        }

        //member
        for ($i = 1; $i <= 100; $i++) {
            //Create Member user
            $member =  \App\Models\User::create([
                'name' => 'Member' . $i,
                'email' => 'member' . $i . '@gmail.com',
                'roles' => 'member',
                'password' => bcrypt("passwordmember$i"),
                'email_verified_at' => now(),
            ]);


            \App\Models\Member::create([
                'name' => 'Member' . $i,
                'no_hp' => '0814345678' . $i,
                'user_id' => $member->id,
                'unit_id' => Unit::all()->random()->id
            ]);

            \App\Models\Passcode::generatePasscode($member->id);
        }
    }
}

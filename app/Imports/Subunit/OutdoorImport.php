<?php

namespace App\Imports\Subunit;

use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OutdoorImport implements ToCollection
{
    public $subunit_id;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $name_index = 5;
        $subunit_index = 2;
        $unit_id = Unit::where('name', 'Kebersihan Outdoor')->first()->id;

        foreach ($rows as $index => $row) {
            //Skip index 0 -> 3
            if ($index < 6) {
                continue;
            }

            if ($row[$name_index] == null) {
                continue;
            }

            if ($row[$subunit_index] != null) {
                //Create Subunit and Coordinator
                $coordinator_user = \App\Models\User::create([
                    'name' => $row[$name_index],
                    'email' => $row[$name_index] . '@example.com',
                    'roles' => 'coordinator',
                    'password' => bcrypt("passwordcoor$index"),
                    'email_verified_at' => now(),
                ]);

                $coordinator = \App\Models\Member::create([
                    'name' => $coordinator_user->name,
                    'no_hp' => '0812345678' . $index,
                    'user_id' => $coordinator_user->id
                ]);

                $subunit = \App\Models\Subunit::create([
                    'name' => 'Subunit ' . $coordinator_user->name,
                    'detail_location' => $row[$subunit_index],
                    'unit_id' => $unit_id,
                    'coordinator_id' => $coordinator->id
                ]);

                \App\Models\Passcode::generatePasscode($coordinator_user->id);

                $this->subunit_id = $subunit->id;
            } else {
                // Create Member
                $user =  \App\Models\User::create([
                    'name' => $row[$name_index],
                    'email' =>  $row[$name_index] . '@example.com',
                    'roles' => 'member',
                    'password' => bcrypt("passwordmember$index"),
                    'email_verified_at' => now(),
                ]);

                $member = \App\Models\Member::create([
                    'name' => $user->name,
                    'no_hp' => '0814345678' . $index,
                    'user_id' => $user->id,
                    'unit_id' => $unit_id
                ]);

                \App\Models\SubunitMember::create([
                    'member_id' => $member->id,
                    'subunit_id' => $this->subunit_id
                ]);

                \App\Models\Passcode::generatePasscode($user->id);
            }
        }
    }
}

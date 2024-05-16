<?php

namespace App\Imports\Subunit;

use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class IndoorSheet implements ToCollection
{
    public $subunit_id, $koordinator;

    public function collection(Collection $rows)
    {
        $name_index = 3;
        $subunit_index = 0;
        $subunit_name = "";
        $koordinator_indicator = "( KORLAP )";
        $unit_id = Unit::where('name', 'Kebersihan Indoor')->first()->id;

        foreach ($rows as $index => $row) {
            //Skip index 0 -> 3
            if ($index < 3) {
                continue;
            }

            if ($row[$subunit_index] != null) {
                if (strpos($row[$subunit_index], $koordinator_indicator)) {
                    //This is Koordinator
                    $koor_name = substr($row[$subunit_index], 0, strpos($row[$subunit_index], $koordinator_indicator));
                    $coordinator_user = \App\Models\User::create([
                        'name' => $koor_name,
                        'email' => $koor_name . '@example.com',
                        'roles' => 'coordinator',
                        'password' => bcrypt("passwordcoor$index"),
                        'email_verified_at' => now(),
                    ]);

                    $coordinator = \App\Models\Member::create([
                        'name' => $coordinator_user->name,
                        'user_id' => $coordinator_user->id
                    ]);

                    $this->koordinator = $coordinator;
                    \App\Models\Passcode::generatePasscode($coordinator_user->id);
                } else {
                    $subunit = \App\Models\Subunit::create([
                        'name' => 'Subunit ' . $row[$subunit_index],
                        'detail_location' => $row[$subunit_index],
                        'unit_id' => $unit_id,
                        'coordinator_id' => $this->koordinator->id
                    ]);

                    $this->subunit_id = $subunit->id;

                    if ($row[$name_index] != null) {
                        //Check if koordinator name is same as $row[$name_index]
                        if (strtolower(trim($this->koordinator->name)) === strtolower(trim($row[$name_index]))) {
                            continue;
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
            } else {
                if ($row[$name_index] == null) continue;
                if (strtolower(trim($this->koordinator->name)) === strtolower(trim($row[$name_index]))) {
                    continue;
                }

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

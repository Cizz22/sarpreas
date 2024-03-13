<?php

namespace App\Imports\Subunit;

use App\Models\Squad;
use App\Models\Unit;
use ErrorException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SKKImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $name_index = 3;
        $squad_index = 4;
        $unit = Unit::where('name', 'SKK')->first()->id;

        foreach ($collection as $index => $row) {
            if ($index < 4) {
                continue;
            }

            if ($row[$name_index] == null) {
                continue;
            }

            $user = \App\Models\User::create([
                'name' => $row[$name_index],
                'email' => $row[$name_index] . '@example.com',
                'roles' => 'member',
                'password' => bcrypt("password$index"),
                'email_verified_at' => now(),
            ]);

            if ($row[$squad_index] == null) {
                $squad = null;
            } else {
                try {
                    $squad = Squad::where('name', $row[$squad_index])->first()->id;
                } catch (ErrorException $e) {
                    dd($row);
                }

            }

            $member = \App\Models\Member::create([
                'name' => $user->name,
                'no_hp' => '0812345678' . $index,
                'user_id' => $user->id,
                'unit_id' => $unit
            ]);

            \App\Models\SquadMember::create([
                'member_id' => $member->id,
                'squad_id' => $squad
            ]);
        }
    }
}

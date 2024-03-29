<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'interval_pattern',
        'leader_id'
    ];

    public function leader()
    {
        return $this->belongsTo(Member::class);
    }

    public function squadMember()
    {
        return $this->hasMany(SquadMember::class);
    }

    public function intervalSchedule()
    {
        return $this->hasMany(IntervalSchedule::class);
    }

    public static function intervalPattern($squad_name)
    {
        $squads = [
            ['A', ['Siang', 'Siang', 'Pagi', 'Pagi', 'Libur', 'Libur', 'Malam', 'Malam']],
            ['B', ['Pagi', 'Pagi', 'Libur', 'Libur', 'Malam', 'Malam', 'Siang', 'Siang']],
            ['C', ['Libur', 'Libur', 'Malam', 'Malam', 'Siang', 'Siang', 'Pagi', 'Pagi']],
            ['D', ['Malam', 'Malam', 'Siang', 'Siang', 'Pagi', 'Pagi', 'Libur', 'Libur']],
            ['Merah', ['Siang', 'Siang', 'Siang', 'Siang', 'Siang', 'Libur', 'Libur', 'Pagi', 'Pagi', 'Pagi', 'Pagi', 'Pagi', 'Libur', 'Libur']],
            ['Putih', ['Pagi', 'Pagi', 'Pagi', 'Pagi', 'Pagi', 'Libur', 'Libur', 'Siang', 'Siang', 'Siang', 'Siang', 'Siang', 'Libur', 'Libur']]
        ];

        foreach ($squads as $squad) {
            if ($squad[0] == $squad_name) {
                return $squad[1];
            }
        }
    }
}

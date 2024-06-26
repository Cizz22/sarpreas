<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'no_hp',
        'user_id',
        'unit_id',
        'total_score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subunitMember()
    {
        return $this->hasOne(SubunitMember::class, 'member_id');
    }

    public function coordinator()
    {
        return $this->hasOne(Subunit::class, 'coordinator_id');
    }

    public function scoreMember()
    {
        return $this->hasMany(ScoreMember::class);
    }

    public function presensi()
    {
        return $this->hasMany(PresensiMember::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function squadMember()
    {
        return $this->hasOne(SquadMember::class, 'member_id');
    }

    public function sessionScheduleMember()
    {
        return $this->hasMany(SessionScheduleMember::class, 'member_id');
    }

    // public function session_schedule()
    // {
    //     return $this->hasMany(SessionSchedule::class, 'member_1_id');
    // }

    public function get_today_session_schedule()
    {
        return $this->session_schedule->where('date', today());
    }

    public function totalPresensibyMonthandYear($month, $year)
    {
        $presensi = $this->presensi()->whereMonth('tanggal_presensi', $month)->whereYear('tanggal_presensi', $year)->get();

        // Initialize counters for each status
        $hadirCount = 0;
        $alphaCount = 0;
        $izinCount = 0;

        // Loop through presensi and accumulate counts
        foreach ($presensi as $record) {
            switch ($record->status) {
                case 'Hadir':
                    $hadirCount++;
                    break;
                case 'Alpha':
                    $alphaCount++;
                    break;
                case 'Izin':
                    $izinCount++;
                    break;
                default:
                    // Handle unexpected status if needed
                    break;
            }
        }

        return "Hadir: " . $hadirCount . " | Alpha: " . $alphaCount . " | Izin: " . $izinCount;
    }


    public function totalScorebyMonthandYear($month, $year)
    {

        // $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        $score = $this->scoreMember()->whereMonth('tanggal_penilaian', $month)->whereYear('tanggal_penilaian', $year)->get();
        $total = 0;
        foreach ($score as $s) {
            $total += $s->total_score;
        }
        // $this->total_score = $total;
        return ($total);
    }

    public function totalPercentagePresensibyMonthandYear($month, $year)
    {
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $presensi = $this->presensi()->whereMonth('tanggal_presensi', $month)->whereYear('tanggal_presensi', $year)->get();
        // 1 if present or izin, 0 if absent

        $total = 0;
        foreach ($presensi as $p) {
            if ($p->status == "hadir" || $p->status == "izin") {
                $total += 1;
            }
        }

        return "$total/$daysInMonth";
    }
}

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
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subunitMember()
    {
        return $this->morphOne(SubunitMember::class, 'memberable');
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

    public function totalScorebyMonthandYear($month, $year)
    {

        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        $score = $this->scoreMember()->whereMonth('tanggal_penilaian', $month)->whereYear('tanggal_penilaian', $year)->get();
        $total = 0;
        foreach ($score as $s) {
            $total += $s->sumScore();
        }
        return ($total / $daysInMonth);
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

        $totalPercentage = ($total / $daysInMonth) * 100;
        return $totalPercentage;
    }
}

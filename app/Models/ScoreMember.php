<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'subunit_id',
        'coordinator_id',
        'tanggal_penilaian',
        'presensi_id'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(Member::class, 'coordinator_id');
    }

    public function subunit()
    {
        return $this->belongsTo(Subunit::class);
    }

    public function scoreDetail()
    {
        return $this->hasMany(ScoreMemberDetail::class);
    }

    //Create Function to calculate sum score
    public function sumScore()
    {
        $score = $this->scoreDetail()->get();
        $total = 0;
        foreach ($score as $s) {
            $total += $s->score;
        }
        return $total;
    }
}

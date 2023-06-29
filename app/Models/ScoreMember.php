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
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function subunit()
    {
        return $this->belongsTo(Subunit::class);
    }

    public function scoreDetail()
    {
        return $this->hasMany(ScoreMemberDetail::class);
    }
}

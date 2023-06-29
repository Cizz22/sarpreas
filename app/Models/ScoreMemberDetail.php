<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreMemberDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'score_member_id',
        'instrument_id',
        'score',
    ];

    public function scoreMember()
    {
        return $this->belongsTo(ScoreMember::class);
    }

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }
}

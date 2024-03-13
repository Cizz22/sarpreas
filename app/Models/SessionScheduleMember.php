<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionScheduleMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_schedule_id',
        'member_id',
    ];

    public function sessionSchedule()
    {
        return $this->belongsTo(SessionSchedule::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}

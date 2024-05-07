<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntervalSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'squad_id',
        'shift_schedule_id',
        'date',
    ];

    public function squad()
    {
        return $this->belongsTo(Squad::class);
    }

    public function shiftSchedule()
    {
        return $this->belongsTo(ShiftSchedule::class);
    }

    public function sessionSchedule()
    {
        return $this->hasMany(SessionSchedule::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'interval_schedule_id',
        'start_time',
        'end_time',
        'status',
        'type',
    ];

    public function intervalSchedule()
    {
        return $this->belongsTo(IntervalSchedule::class);
    }
}

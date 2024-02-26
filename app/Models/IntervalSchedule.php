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
}

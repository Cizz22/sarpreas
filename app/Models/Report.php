<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'session_schedule_id',
        'location_id',
        'situation',
        'latitude',
        'longitude',
        'additional_information'
    ];
}

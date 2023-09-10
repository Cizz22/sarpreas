<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_1_id',
        'member_2_id',
        'shift',
        'date',
        'unit_id',
        'status'
    ];

    public function member_1()
    {
        return $this->belongsTo(Member::class, 'member_1_id');
    }

    public function member_2()
    {
        return $this->belongsTo(Member::class, 'member_2_id');
    }
}

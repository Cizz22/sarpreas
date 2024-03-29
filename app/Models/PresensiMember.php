<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'subunits_id',
        'coordinator_id',
        'status',
        'tanggal_presensi',
    ];
}

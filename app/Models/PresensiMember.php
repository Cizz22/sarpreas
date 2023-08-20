<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'subunit_id',
        'coordinator_id',
        'status'
    ];
}

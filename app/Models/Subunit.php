<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subunit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail_location', // Change 'detail_location' from 'location' to 'detail_location
        'unit_id',
        'coordinator_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function subunitMember()
    {
        return $this->hasMany(SubunitMember::class);
    }

    public function coordinator()
    {
        return $this->belongsTo(Member::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'instrument',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function score()
    {
        return $this->hasMany(ScoreMemberDetail::class);
    }
}

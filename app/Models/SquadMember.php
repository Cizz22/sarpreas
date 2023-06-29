<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'squad_id',
        'member_id'
    ];

    public function squad()
    {
        return $this->belongsTo(Squad::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}

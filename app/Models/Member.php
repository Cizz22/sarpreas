<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'no_hp',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subunitMember()
    {
        return $this->morphOne(SubunitMember::class, 'memberable');
    }

    public function coordinator(){
        return $this->hasOne(Subunit::class, 'coordinator_id');
    }

    public function scoreMember()
    {
        return $this->hasMany(ScoreMember::class);
    }
}

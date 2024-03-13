<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubunitMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'subunit_id',
        'member_id',
    ];

    public function subunit()
    {
        return $this->belongsTo(Subunit::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }
}

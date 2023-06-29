<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubunitMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'subunit_id',
        'memberable_id',
        'memberable_type'
    ];

    public function subunit()
    {
        return $this->belongsTo(Subunit::class);
    }

    public function memberable()
    {
        return $this->morphTo();
    }
}

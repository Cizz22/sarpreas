<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function subunits()
    {
        return $this->hasMany(Subunit::class);
    }

    public function instruments(){
        return $this->hasMany(Instrument::class);
    }
}

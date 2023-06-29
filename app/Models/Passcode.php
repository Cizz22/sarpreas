<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'passcode',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generatePasscode($user_id)
    {
        $passcode = rand(100000, 999999);

        // Check if the passcode already exists for any coordinator
        $existingPasscode = static::where('passcode', $passcode)->exists();

        // If it exists, regenerate a new passcode
        if ($existingPasscode) {
            return static::generatePasscode($user_id);
        }

        return static::create([
            'passcode' => $passcode,
            'user_id' => $user_id,
        ]);
    }
}

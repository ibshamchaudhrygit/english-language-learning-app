<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user who earned the badge.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the badge that was earned.
     */
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user who earned the certificate.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lesson this certificate is for.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
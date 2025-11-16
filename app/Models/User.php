<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ extend the right base class
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    // Relationships
    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}

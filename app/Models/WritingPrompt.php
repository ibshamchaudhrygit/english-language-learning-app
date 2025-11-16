<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WritingPrompt extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function submissions()
    {
        return $this->hasMany(WritingSubmission::class);
    }
}
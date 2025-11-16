<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

        /**
     * Get the parent thread (if this is a reply).
     */
    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    /**
     * Get the replies to this thread.
     */
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }

    // --- END ADDED ---
}

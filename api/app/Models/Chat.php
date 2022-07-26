<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}

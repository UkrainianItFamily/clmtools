<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLecture(): Lecture
    {
        return $this->lecture;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }
}

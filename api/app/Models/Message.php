<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    protected $fillable = ['body'];
    protected $appends = ['self_message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function getSelfMessageAttribute()
    {
        return $this->user_id === auth()->user()->id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }
}

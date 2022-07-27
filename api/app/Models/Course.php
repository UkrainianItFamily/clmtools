<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lectures(): HasMany {
        return $this->hasMany(Lecture::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

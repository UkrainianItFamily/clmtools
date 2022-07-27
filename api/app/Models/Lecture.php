<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'preview_image', 'link'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }
}

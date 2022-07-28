<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description' , 'preview_image', 'link', 'course_id', 'author_id'];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function author(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

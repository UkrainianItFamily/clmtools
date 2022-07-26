<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function lectures() {
        return $this->hasMany(Lecture::class);
    }
}

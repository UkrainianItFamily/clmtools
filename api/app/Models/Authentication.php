<?php

declare(strict_types=1);

namespace App\Models;

final class Authentication
{
    public static function getAuthUserId(): int
    {
        return \Auth::id();
    }

    public static function isUserLecturer(): ?bool
    {
        return \Auth::user()->lecturer == true;
    }
}

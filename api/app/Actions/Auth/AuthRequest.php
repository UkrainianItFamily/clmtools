<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class AuthRequest
{
    public static function getAuthUserId(): int
    {
        return \Auth::id();
    }

    public static function isUserLecturer(): ?bool
    {
        return \Auth::user()->lecturer;
    }
}

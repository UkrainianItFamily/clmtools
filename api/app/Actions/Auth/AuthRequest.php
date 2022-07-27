<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class AuthRequest
{
    public function getAuthUserId(): int
    {
        return \Auth::id();
    }
}

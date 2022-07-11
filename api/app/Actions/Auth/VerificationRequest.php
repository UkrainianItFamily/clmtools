<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Http\Request;

final class VerificationRequest
{
    public function __construct(
        private int $user_id,
        private Request $request,
    ) {
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}

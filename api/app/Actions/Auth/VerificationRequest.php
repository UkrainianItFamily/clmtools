<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Http\Request;

final class VerificationRequest
{
    public function __construct(
        private int $user_id,
        private Request $request,
        private string $expires,
        private string $hash,
        private string $signature
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

    public function getExpires(): string
    {
        return $this->expires;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getSignature(): string
    {
        return $this->signature;
    }
}

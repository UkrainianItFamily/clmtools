<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Auth\Notifications\ResetPassword;

final class ForgotPasswordRequest
{
    public function __construct(
        private string $email
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}

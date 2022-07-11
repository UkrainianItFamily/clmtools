<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Exceptions\EmailAlreadyVerifiedException;

final class ResendVerificationAction
{
    public function execute(): void
    {
        if (auth()->user()->hasVerifiedEmail()) {
            throw new EmailAlreadyVerifiedException();
        }

        auth()->user()->sendEmailVerificationNotification();
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\Actions\Auth\ForgotPasswordResponse;

final class ForgotPasswordAction
{
    use SendsPasswordResetEmails;

    public function execute(ForgotPasswordRequest $request)
    {
        $response = Password::broker()->sendResetLink(['email' => $request->getEmail()]);

        return $response;
    }
}

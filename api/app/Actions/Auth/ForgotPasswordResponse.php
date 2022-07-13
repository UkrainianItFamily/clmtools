<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class ForgotPasswordResponse
{
    public function sendResetLinkResponse(ForgotPasswordRequest $request, $response): array
    {
        return [
            'message' => 'Password reset email sent.',
            'data' => $response
        ];
    }

    public function sendResetLinkFailedResponse(ForgotPasswordRequest $request, $response)
    {
        return 'Email could not be sent to this email address.';
    }

}

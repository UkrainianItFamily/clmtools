<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class ResetPasswordResponse
{
    public function sendResetResponse(ResetPasswordRequest $request, $response): array
    {
        return [
            'message' => 'Password reset email sent.',
            'data' => $response
        ];
    }

    public function sendResetFailedResponse(ResetPasswordRequest $request, $response)
    {
        return 'Failed, Invalid Token.';
    }

}

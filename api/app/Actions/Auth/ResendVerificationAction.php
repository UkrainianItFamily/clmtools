<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Http\JsonResponse;

final class ResendVerificationAction
{
    public function execute(): JsonResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(["msg" => "Email already verified."], 400);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response()->json(["msg" => "Email verification link sent on your email id"]);
    }
}

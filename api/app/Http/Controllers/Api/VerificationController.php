<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\ResendVerificationAction;
use App\Actions\Auth\VerificationAction;
use App\Actions\Auth\VerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends ApiController
{
    public function verify(
        $user_id,
        Request $request,
        VerificationAction $action,
    ): JsonResponse {
        $verificationRequest = new VerificationRequest(
            (int)$user_id,
            $request,
        );

        $action->execute($verificationRequest);

        return $this->successResponse(['msg' => 'User successfully verified.'], 200);
    }

    public function resend(
        ResendVerificationAction $action,
    ) {
        $action->execute();

        return $this->successResponse(['msg' => 'Email verification link sent on your email.']);
    }
}

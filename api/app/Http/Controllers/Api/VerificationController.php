<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\ResendVerificationAction;
use App\Actions\Auth\VerificationAction;
use App\Actions\Auth\VerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends ApiController
{
    public function verify(
        $user_id,
        Request $validSignature,
        VerificationAction $action,
    ): JsonResponse {
        $verificationRequest = new VerificationRequest(
            (int)$user_id,
            $validSignature,
        );

        $action->execute($verificationRequest);

        return $this->successResponse(['msg' => 'User successfully verified.'], 200);
    }

    public function resend(
        $user_id,
        ResendVerificationAction $action,
        Request $request,
    ) {
        $action->execute(
            new VerificationRequest(
                (int)$user_id,
                $request,
            )
        );

        return $this->successResponse(['msg' => 'Email verification link sent on your email.']);
    }
}

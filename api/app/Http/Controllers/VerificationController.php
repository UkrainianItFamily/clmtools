<?php

namespace App\Http\Controllers;

use App\Actions\Auth\ResendVerificationAction;
use App\Actions\Auth\VerificationAction;
use App\Actions\Auth\VerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(
        $user_id,
        Request $request,
        VerificationAction $action,
    ): JsonResponse {
        $verificationRequest = new VerificationRequest(
            $user_id,
            $request,
            $request->get('expires'),
            $request->get('hash'),
            $request->get('signature')
        );

        return $action->execute($verificationRequest);
    }

    public function resend(
        ResendVerificationAction $action,
    ) {
        return $action->execute();
    }
}

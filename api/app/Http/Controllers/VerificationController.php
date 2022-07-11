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
        $request = new VerificationRequest(
            $user_id,
            $request
        );

        return $action->execute($request);
    }

    public function resend(
        ResendVerificationAction $action,
    ) {
        return $action->execute();
    }
}

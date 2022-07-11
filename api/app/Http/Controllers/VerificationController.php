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

        $action->execute($verificationRequest);

        return response()->json(['msg' => 'User successfully verified.'], 200);
    }

    public function resend(
        ResendVerificationAction $action,
    ) {
        $action->execute();

        return response()->json(["msg" => "Email verification link sent on your email id"]);
    }
}

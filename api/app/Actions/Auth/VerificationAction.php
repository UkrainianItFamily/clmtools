<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;

final class VerificationAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(VerificationRequest $request): JsonResponse
    {
        if (!$request->getRequest()->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        $user = $this->userRepository->getById($request->getUserId());

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json(["msg" => "User successfully verified."], 200);
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Exceptions\InvalidExpiredUrlProvidedException;
use App\Repository\UserRepository;

final class VerificationAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(VerificationRequest $request): void
    {
        if (!$request->getRequest()->hasValidSignature()) {
            throw new InvalidExpiredUrlProvidedException();
        }

        $user = $this->userRepository->getById($request->getUserId());

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    }
}

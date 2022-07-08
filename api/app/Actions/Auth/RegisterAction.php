<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Repository\UserRepository;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;

final class RegisterAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(RegisterRequest $request): AuthenticationResponse
    {
        $user = $this->userRepository->create([
            'name' => $request->getName(),
            'last_name' => $request->getLastName(),
            'email' => $request->getEmail(),
            'phone' => $request->getPhone(),
            'password' => $request->getPassword()
        ]);
        $user->sendEmailVerificationNotification();

        $token = auth()->login($user);


        //$this->mailer->to($user)->send(new WelcomeEmail());

        return new AuthenticationResponse(
            (string)$token,
            'bearer',
            auth()->factory()->getTTL() * 60
        );
    }
}

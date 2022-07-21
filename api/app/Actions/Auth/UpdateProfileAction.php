<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Actions\Auth\UpdateProfileResponse;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

final class UpdateProfileAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(UpdateProfileRequest $request): UpdateProfileResponse
    {
        $user = Auth::user();

        $user->name = $request->getName() ?: $user->name;
        $user->last_name = $request->getLastName() ?: $user->last_name;
        $user->date_birth = $request->getDateBirth() ?: $user->date_birth;
        $user->city = $request->getCity() ?: $user->city;
        $user->university = $request->getUniversity() ?: $user->university;
        $user->graduation_year = $request->getGraduationYear() ?: $user->graduation_year;

        $user = $this->userRepository->save($user);

        return new UpdateProfileResponse($user);
    }
}

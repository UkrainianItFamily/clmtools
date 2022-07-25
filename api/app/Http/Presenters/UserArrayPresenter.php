<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\User;

final class UserArrayPresenter
{
    public function present(User $user): array
    {
        return [
            'id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'last_name' => $user->getLastName(),
            'date_birth' => $user->getDateBirth(),
            'phone' => $user->getPhone(),
            'email_verified_at' => $user->getVerifiedEmail(),
            'city' => $user->getCity(),
            'university' => $user->getUniversity(),
            'graduation_year' => $user->getGraduationYear(),
            'lecturer' => $user->getUserRoleLecturer(),
        ];
    }
}

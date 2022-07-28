<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Exceptions\InvalidChangePasswordNewPasswordEqualOldPasswordException;
use App\Exceptions\InvalidChangePasswordWrongOldPasswordException;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class ChangePasswordAction
{
    public function execute(ChangePasswordRequest $request): void
    {
        $user = Auth::user();

        if(Hash::check($request->getOldPassword(),$user->password) == false)
        {
            throw new InvalidChangePasswordWrongOldPasswordException();
        }
        else if (Hash::check($request->getNewPassword(),$user->password))
        {
            throw new InvalidChangePasswordNewPasswordEqualOldPasswordException();
        }
        $user->forceFill(['password' => Hash::make($request->getNewPassword())])->save();
    }
}

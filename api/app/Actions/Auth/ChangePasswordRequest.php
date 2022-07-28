<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class ChangePasswordRequest
{
    public function __construct(
        private string $old_password,
        private string $new_password,
        private string $new_password_confirmation
    ) {
    }

    public function getOldPassword(): string
    {
        return $this->old_password;
    }

    public function getNewPassword(): string
    {
        return $this->new_password;
    }

    public function getNewPasswordConfirmation(): string
    {
        return $this->new_password_confirmation;
    }
}

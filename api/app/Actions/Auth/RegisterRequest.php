<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class RegisterRequest
{
    public function __construct(
        private string $name,
        private string $lastName,
        private string $email,
        private string $phone,
        private string $password
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

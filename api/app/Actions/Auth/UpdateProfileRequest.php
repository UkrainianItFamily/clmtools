<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class UpdateProfileRequest
{
    public function __construct(
        private string $name,
        private string $lastName,
        private string $dateBirth,
        private string $city,
        private string $university,
        private int $graduationYear,
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

    public function getDateBirth(): string{
        return $this->dateBirth;
    }

    public function getCity(): string{
        return $this->city;
    }

    public function getUniversity(): string{
        return $this->university;
    }

    public function getGraduationYear(): int{
        return $this->graduationYear;
    }

}

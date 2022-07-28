<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class UpdateProfileRequest
{
    public function __construct(
        private string $name,
        private string $lastName,
        private ?string $dateBirth,
        private ?int $city,
        private ?int $university,
        private ?int $graduationYear,
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

    public function getDateBirth(): ?string{
        return $this->dateBirth;
    }

    public function getCity(): ?int{
        return $this->city;
    }

    public function getUniversity(): ?int{
        return $this->university;
    }

    public function getGraduationYear(): ?int{
        return $this->graduationYear;
    }

}

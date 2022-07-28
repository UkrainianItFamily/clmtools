<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

final class UniversityResponse
{
    public function __construct(
        private object $university,
    ) {
    }

    public function getUniversityName(): ?string
    {
        return $this->university->name;
    }

    public function getUniversityId(): int
    {
        return $this->university->id;
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

final class UniversityRequest
{
    public function __construct(
        private int $university_id
    ) {
    }

    public function getUniversityId(): int
    {
        return $this->university_id;
    }
}

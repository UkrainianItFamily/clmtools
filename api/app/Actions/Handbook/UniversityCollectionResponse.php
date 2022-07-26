<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

final class UniversityCollectionResponse
{
    public function __construct(
        private $university,
    ) {
    }

    public function getUniversity()
    {
        return $this->university;
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

use Illuminate\Database\Eloquent\Collection;

final class UniversityCollectionResponse
{
    public function __construct(
        private $university,
    ) {
    }

    public function getUniversity(): Collection
    {
        return $this->university;
    }
}

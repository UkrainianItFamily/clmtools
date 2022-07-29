<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

final class CityResponse
{
    public function __construct(
        private object $city,
    ) {
    }

    public function getCityName(): ?string
    {
        return $this->city->name;
    }

    public function getCityId(): int
    {
        return $this->city->id;
    }
}

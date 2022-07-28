<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

final class CityRequest
{
    public function __construct(
        private int $city_id
    ) {
    }

    public function getCityId(): int
    {
        return $this->city_id;
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

use Illuminate\Database\Eloquent\Collection;

final class CityCollectionResponse
{
    public function __construct(
        private $city,
    ) {
    }

    public function getCity(): Collection
    {
        return $this->city;
    }
}

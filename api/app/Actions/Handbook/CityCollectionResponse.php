<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

final class CityCollectionResponse
{
    public function __construct(
        private $city,
    ) {
    }

    public function getCity()
    {
        return $this->city;
    }
}

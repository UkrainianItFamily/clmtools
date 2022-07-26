<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

use App\Repository\CityRepository;

final class CityCollectionAction
{
    public function __construct(private CityRepository $cityRepository)
    {
    }

    public function execute(): CityCollectionResponse
    {
        return new CityCollectionResponse(
            $this->cityRepository->getAll()
        );
    }
}

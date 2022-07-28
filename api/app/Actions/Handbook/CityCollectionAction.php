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
        $repository = $this->cityRepository;
        $cities = $repository->getAll();

        return new CityCollectionResponse($cities);
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

use App\Repository\CityRepository;

final class CityAction
{
    public function __construct(private CityRepository $cityRepository)
    {
    }

    public function execute(CityRequest $request): CityResponse
    {
        $repository = $this->cityRepository;
        $city_id = $request->getCityId();
        $city = $repository->getById($city_id);

        return new CityResponse($city);
    }
}

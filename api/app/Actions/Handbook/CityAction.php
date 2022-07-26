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
        return new CityResponse(
            $this->cityRepository->getById($request->getCityId())
        );
    }
}

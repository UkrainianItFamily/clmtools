<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Handbook\CityCollectionResponse;
use App\Actions\Handbook\CityResponse;
use App\Models\City;

final class CityArrayPresenter
{
    public function present(City $city): array
    {
        return [
            'id' => $city->getId(),
            'name' => $city->getName(),
        ];
    }

    public function getCollections(CityCollectionResponse $cities): array
    {
        return $cities->getCity()
            ->map(
                function (City $city) {
                    return $this->present(new CityResponse($city));
                }
            )
            ->all();
    }
}

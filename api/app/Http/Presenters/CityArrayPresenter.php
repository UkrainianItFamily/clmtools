<?php

declare(strict_types=1);

namespace App\Http\Presenters;

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
}

<?php

namespace App\Http\Controllers\Api;

use App\Actions\Handbook\CityAction;
use App\Actions\Handbook\CityCollectionAction;
use App\Actions\Handbook\CityRequest;
use App\Http\Presenters\CityArrayPresenter;
use Illuminate\Http\JsonResponse;

class HandbookControllers extends ApiController
{
    /**
     * Getting cities list
     */
    public function getCities(
        CityCollectionAction $action,
        CityArrayPresenter $presenter
    ): JsonResponse {
        $response = $action->execute();

        return $this->successResponse($presenter->getCollections($response));
    }

    /**
     * Getting city data
     */
    public function city(
        $city_id,
        CityAction $action,
        CityArrayPresenter $presenter
    ): JsonResponse {
        $response = $action->execute(new CityRequest(
            (int)$city_id,
        ));

        return $this->successResponse($presenter->present($response));
    }
}

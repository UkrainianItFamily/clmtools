<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Handbook\UniversityCollectionResponse;
use App\Actions\Handbook\UniversityResponse;
use App\Models\University;

final class UniversityArrayPresenter
{
    public function present(University $university): array
    {
        return [
            'id' => $university->getId(),
            'name' => $university->getName(),
        ];
    }


    public function getCollections(UniversityCollectionResponse $cities): array
    {
        return $cities->getUniversity()
            ->map(
                function (University $university) {
                    return $this->present(new UniversityResponse($university));
                }
            )
            ->all();
    }
}

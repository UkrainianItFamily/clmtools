<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Handbook\UniversityCollectionResponse;
use App\Actions\Handbook\UniversityResponse;
use App\Models\University;

final class UniversityArrayPresenter
{
    public function present(UniversityResponse $university): array
    {
        return [
            'id' => $university->getUniversityId(),
            'name' => $university->getUniversityName(),
        ];
    }

    public function getCollections(UniversityCollectionResponse $university): array
    {
        return $university->getUniversity()
            ->map(
                function (University $university) {
                    return $this->present(new UniversityResponse($university));
                }
            )
            ->all();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Lecture\LectureCollectionResponse;
use App\Actions\Lecture\LectureResponse;
use App\Models\Lecture;

final class LectureArrayPresenter
{
    public function present(LectureResponse $lecture): array
    {
        return [
            'title' => $lecture->getLectureTitle(),
            'image' => $lecture->getLectureImage(),
            'link' => $lecture->getLectureLink(),
            'created_at' => $lecture->getLectureDate(),
        ];
    }

    public function getCollections(LectureCollectionResponse $lectures): array
    {
        return $lectures->getLecture()
            ->map(
                function (Lecture $lecture) {
                    return $this->present(new LectureResponse($lecture));
                }
            )
            ->all();
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Repository\LectureRepository;

final class LectureCollectionAction
{
    public function __construct(private LectureRepository $lectureRepository)
    {
    }

    public function execute(LectureCollectionRequest $request): LectureCollectionResponse
    {
        return new LectureCollectionResponse(
            $this->lectureRepository->getLecturesByUser($request->getUserId())
        );
    }
}

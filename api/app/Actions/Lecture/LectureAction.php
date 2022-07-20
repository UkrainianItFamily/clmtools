<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Repository\LectureRepository;

final class LectureAction
{
    public function __construct(private LectureRepository $lectureRepository)
    {
    }

    public function execute(LectureRequest $request): LectureResponse
    {
        return new LectureResponse(
            $this->lectureRepository->getById($request->getLectureId())
        );
    }
}

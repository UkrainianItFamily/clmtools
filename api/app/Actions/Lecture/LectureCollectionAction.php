<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Models\User;
use App\Repository\{LectureRepository, UserRepository};

final class LectureCollectionAction
{
    public function __construct(private LectureRepository $lectureRepository, private UserRepository $userRepository)
    {
    }

    public function execute(LectureCollectionRequest $request): LectureCollectionResponse
    {
        $response = User::isUserLecturer() ?
            $this->lectureRepository->getLecturesByLecturer($request->getUserId()) :
            $this->userRepository->getLecturesByUser($request->getUserId());

        return new LectureCollectionResponse(
            $response
        );
    }
}

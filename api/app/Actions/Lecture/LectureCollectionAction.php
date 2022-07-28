<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Actions\Auth\AuthRequest;
use App\Repository\{LectureRepository, UserRepository};

final class LectureCollectionAction
{
    public function __construct(private LectureRepository $lectureRepository, private UserRepository $userRepository)
    {
    }

    public function execute(LectureCollectionRequest $request): LectureCollectionResponse
    {
        $response = AuthRequest::isUserLecturer() ?
            $this->lectureRepository->getLecturesByLecturer($request->getUserId()) :
            $this->userRepository->getLecturesByUser($request->getUserId());

        return new LectureCollectionResponse(
            $response
        );
    }
}

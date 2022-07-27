<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Actions\Auth\AuthRequest;
use App\Repository\{CourseRepository, UserRepository};

final class LectureFormAction
{
    public function __construct(private CourseRepository $courseRepository, private UserRepository $userRepository)
    {
    }

    public function execute(AuthRequest $request): LectureFormResponse
    {
        return new LectureFormResponse(
            $this->courseRepository->getCoursesByUser($request->getAuthUserId()),
            $this->userRepository->getStudents(),
        );
    }
}

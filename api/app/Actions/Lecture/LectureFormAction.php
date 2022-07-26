<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Repository\LectureRepository;

final class LectureFormAction
{
    public function __construct(private CourseRepository $courseRepository, private UserRepository $userRepository)
    {
    }

    public function execute(LectureFormRequest $request): LectureFormResponse
    {
        return new LectureFormResponse(
            $this->courseRepository->getCoursesByUser($request->getAuthUserId()),
            $this->userRepository->getStudents(),
        );
    }
}

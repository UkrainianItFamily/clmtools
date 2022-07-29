<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Models\Authentication;
use App\Repository\{CourseRepository, UserRepository};

final class LectureFormAction
{
    public function __construct(private CourseRepository $courseRepository, private UserRepository $userRepository)
    {
    }

    public function execute(): LectureFormResponse
    {
        return new LectureFormResponse(
            $this->courseRepository->getCoursesByUser(Authentication::getAuthUserId()),
            $this->userRepository->getStudents(),
        );
    }
}

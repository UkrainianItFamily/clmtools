<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Course;

final class CourseArrayPresenter
{
    public function present(Course $course): array
    {
        return [
            'id' => $course->getId(),
            'avatar' => $course->getAvatar(),
            'email' => $course->getEmail(),
            'name' => $course->getName(),
            'last_name' => $course->getLastName(),
            'date_birth' => $course->getDateBirth(),
        ];
    }

    public function getCollections(Course $courses): array
    {
        return $courses->map(
                function (Course $course) {
                    return $this->present($course);
                }
            )
            ->all();
    }
}

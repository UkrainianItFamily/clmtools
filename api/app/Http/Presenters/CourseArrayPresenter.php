<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

final class CourseArrayPresenter
{
    public function present(Course $course): array
    {
        return [
            'id' => $course->getId(),
            'title' => $course->getTitle(),
        ];
    }

    public function getCollections(Collection $courses): array
    {
        return $courses->map(
                function (Course $course) {
                    return $this->present($course);
                }
            )
            ->all();
    }
}

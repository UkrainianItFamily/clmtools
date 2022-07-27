<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use \Illuminate\Database\Eloquent\Collection;

final class LectureFormResponse
{
    public function __construct(
        private object $courses,
        private object $students,
    ) {
    }

    public function getCourses(): ?Collection
    {
        return $this->courses;
    }

    public function getStudents(): ?Collection
    {
        return $this->students;
    }
}

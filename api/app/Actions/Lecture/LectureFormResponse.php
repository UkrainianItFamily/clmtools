<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use Illuminate\Support\Carbon;

final class LectureFormResponse
{
    public function __construct(
        private object $courses,
        private object $students,
    ) {
    }

    public function getCourses(): ?string
    {
        return $this->courses;
    }

    public function getStudents(): ?string
    {
        return $this->students;
    }
}
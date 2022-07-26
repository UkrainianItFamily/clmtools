<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class CourseRepository
{
    public function create(array $fields): Course
    {
        return Course::create($fields);
    }

    public function getById(int $id): Course
    {
        return Course::findOrFail($id);
    }

    public function save(Course $course): Course
    {
        $course->save();

        return $course;
    }

    public function getCoursesByUser(int $id): Collection
    {
        return Course::where('user_id', $id)
            ->orderBy('title', 'asc')
            ->get();
    }
}

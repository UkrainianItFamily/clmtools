<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Lecture\LectureCollectionResponse;
use App\Actions\Lecture\LectureFormResponse;
use App\Actions\Lecture\LectureResponse;
use App\Models\Lecture;

final class LectureArrayPresenter
{
    public function present(LectureResponse $lecture): array
    {
        return [
            'id' => $lecture->getLectureId(),
            'title' => $lecture->getLectureTitle(),
            'image' => $lecture->getLectureImage(),
            'link' => $lecture->getLectureLink(),
            'created_at' => $lecture->getLectureDate(),
            'course' => $lecture->getLectureCourse(),
        ];
    }

    public function getCollections(LectureCollectionResponse $lectures): array
    {
        return $lectures->getLecture()
            ->map(
                function (Lecture $lecture) {
                    return $this->present(new LectureResponse($lecture));
                }
            )
            ->all();
    }

    public function getDataFormLecturer(LectureFormResponse $data): array
    {
        $user_presenter = new UserArrayPresenter();
        $courses_presenter = new CourseArrayPresenter();
        return [
            'courses' =>  $courses_presenter->getCollections($data->getCourses()),
            'students' => $user_presenter->getCollections($data->getStudents()),
        ];
    }
}

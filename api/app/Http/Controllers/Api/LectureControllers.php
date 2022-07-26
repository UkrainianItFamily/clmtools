<?php

namespace App\Http\Controllers\Api;

use App\Actions\Lecture\LectureAction;
use App\Actions\Lecture\LectureCollectionAction;
use App\Actions\Lecture\LectureCollectionRequest;
use App\Actions\Lecture\LectureFormAction;
use App\Actions\Lecture\LectureFormRequest;
use App\Actions\Lecture\LectureRequest;
use App\Http\Presenters\LectureArrayPresenter;
use Illuminate\Http\JsonResponse;

class LectureControllers extends ApiController
{
    /**
     * Getting lectures list for user
     */
    public function userLectures(
        $user_id,
        LectureCollectionAction $action,
        LectureArrayPresenter $presenter
    ): JsonResponse {
        $response = $action->execute(new LectureCollectionRequest(
            (int)$user_id
        ));

        return $this->successResponse($presenter->getCollections($response));
    }

    /**
     * Getting lecture data
     */
    public function lecture(
        $lecture_id,
        LectureAction $action,
        LectureArrayPresenter $presenter
    ): JsonResponse {
        $response = $action->execute(new LectureRequest(
            (int)$lecture_id,
        ));

        return $this->successResponse($presenter->present($response));
    }

    /**
     * Getting all data for lecturer
     */
    public function formLecture(
        LectureFormAction $action,
        LectureArrayPresenter $presenter
    ): JsonResponse {
        $response = $action->execute(new LectureFormRequest());

        return $this->successResponse($presenter->getDataFormLecturer($response));
    }
}

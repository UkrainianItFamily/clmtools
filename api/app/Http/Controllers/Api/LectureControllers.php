<?php

namespace App\Http\Controllers\Api;

use App\Actions\Lecture\LectureAction;
use App\Actions\Lecture\LectureRequest;
use App\Http\Presenters\LectureArrayPresenter;
use App\Http\Presenters\LecturesListArrayPresenter;
use Illuminate\Http\JsonResponse;

class LectureControllers extends ApiController
{
    /**
     * Getting lectures list for user
     */
    public function userLectures(
        $user_id,
        LectureAction $action,
        LecturesListArrayPresenter $listPresenter
    ): JsonResponse {
        $response = $action->execute(new LectureRequest(
            (int)$user_id,
            null,
        ));

        return $this->successResponse($listPresenter->present($response));
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
            null,
            (int)$lecture_id,
        ));

        return $this->successResponse($presenter->present($response));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Authentication;
use App\Actions\Lecture\LectureAction;
use App\Actions\Lecture\LectureCollectionAction;
use App\Actions\Lecture\LectureCollectionRequest;
use App\Actions\Lecture\LectureCreateAction;
use App\Actions\Lecture\LectureCreateRequest;
use App\Actions\Lecture\LectureFormAction;
use App\Actions\Lecture\LectureRequest;
use App\Actions\Lecture\LectureVerificationRequest;
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
        $response = $action->execute();

        return $this->successResponse($presenter->getDataFormLecturer($response));
    }

    /**
     * Create a new lecture
     */
    public function createLecture(
        LectureVerificationRequest $validationRequest,
        LectureCreateAction $action,
        LectureArrayPresenter $presenter
    ): JsonResponse {
        if (!Authentication::isUserLecturer()) {
            return $this->errorResponse(__('authorize.forbidden_by_role'));
        }
        $request = new LectureCreateRequest(
            $validationRequest->get('title'),
            $validationRequest->get('description'),
            $validationRequest->get('link'),
            $validationRequest->get('course_id'),
            $validationRequest->get('user_id')
        );
        $response = $action->execute($request);

        return $this->successResponse($presenter->present($response));
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\RegisterRequest;
use App\Http\Presenters\AuthenticationResponseArrayPresenter;
use App\Http\Requests\Api\Auth\RegisterHttpRequest;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class RegistrationController extends ApiController
{
    /**
     * Register a new user
     */
   public function register(
        RegisterHttpRequest $httpRequest,
        RegisterAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ): JsonResponse {
        $request = new RegisterRequest(
            $httpRequest->get('name'),
            $httpRequest->get('last_name'),
            $httpRequest->get('email'),
            $httpRequest->get('phone'),
            $httpRequest->get('password')
        );

        $response = $action->execute($request);

        return $this->successResponse($authenticationResponseArrayPresenter->present($response));
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Http\Presenters\AuthenticationResponseArrayPresenter;
use App\Http\Requests\Api\Auth\LoginHttpRequest;

final class AuthController extends ApiController
{
    public function login(
        LoginHttpRequest $httpRequest,
        LoginAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ) {
        $request = new LoginRequest(
            $httpRequest->email,
            $httpRequest->password
        );

        $response = $action->execute($request);

        if(!$response->getExpiresIn()){
            return $this->errorResponse('Unauthorized');
        }

        return $this->successResponse($authenticationResponseArrayPresenter->present($response));
    }
}

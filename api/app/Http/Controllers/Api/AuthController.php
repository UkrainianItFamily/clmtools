<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Auth\ForgotPasswordAction;
use App\Actions\Auth\ForgotPasswordRequest;
use App\Actions\Auth\ForgotPasswordResponse;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Http\Presenters\AuthenticationResponseArrayPresenter;
use App\Http\Requests\Api\Auth\AuthRequest;
use App\Http\Requests\Api\Auth\PasswordResetLinkRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

final class AuthController extends ApiController
{

    public function login(
        AuthRequest $authRequest,
        LoginAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ) {
        $request = new LoginRequest(
            $authRequest->email,
            $authRequest->password
        );

        $response = $action->execute($request);

        if(!$response->getExpiresIn()){
            return $this->errorResponse('Unauthorized');
        }

        return $this->successResponse($authenticationResponseArrayPresenter->present($response));
    }

    public function forgotPassword(
        PasswordResetLinkRequest $passwordResetLinkRequest,
        ForgotPasswordAction $action,
        ForgotPasswordResponse $forgotPasswordResponse
    ) {
        $request = new ForgotPasswordRequest(
            $passwordResetLinkRequest->email
        );

        $response = $action->execute($request);

        return $response == Password::RESET_LINK_SENT
            ? $this->successResponse($forgotPasswordResponse->sendResetLinkResponse($request, $response))
            : $this->errorResponse($forgotPasswordResponse->sendResetLinkFailedResponse($request, $response));
    }

}

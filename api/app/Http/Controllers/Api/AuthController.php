<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Auth\UploadProfileImageAction;
use App\Actions\Auth\UploadProfileImageRequest;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\ForgotPasswordAction;
use App\Actions\Auth\ForgotPasswordRequest;
use App\Actions\Auth\GetAuthenticatedUserAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Actions\Auth\ResetPasswordAction;
use App\Actions\Auth\ResetPasswordRequest;
use App\Actions\Auth\UpdateProfileAction;
use App\Actions\Auth\UpdateProfileRequest;
use App\Http\Presenters\AuthenticationResponseArrayPresenter;
use App\Http\Presenters\UserArrayPresenter;
use App\Http\Requests\Api\Auth\UploadProfileImageValidationRequest;
use App\Http\Requests\Api\Auth\AuthRequest;
use App\Http\Requests\Api\Auth\PasswordResetLinkRequest;
use App\Http\Requests\Api\Auth\ResetRequest;
use App\Http\Requests\Api\Auth\UpdateValidationRequest;
use App\Http\Response\ApiResponse;
use Illuminate\Http\JsonResponse;

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
        ForgotPasswordAction $action
    ) {
        $request = new ForgotPasswordRequest(
            $passwordResetLinkRequest->email
        );

        $action->execute($request);

        return $this->successResponse(['msg' => __('passwords.sent')], 200);
    }

    public function reset(
        ResetRequest $resetRequest,
        ResetPasswordAction $action
    ) {
        $request = new ResetPasswordRequest(
            $resetRequest->token,
            $resetRequest->email,
            $resetRequest->password,
            $resetRequest->password_confirmation
        );

        $action->execute($request);

        return $this->successResponse(['msg' => __('passwords.reset')], 200);
    }

    public function logout(
        LogoutAction $action
    ): JsonResponse
    {
        $action->execute();

        return $this->emptyResponse();
    }

    public function me(GetAuthenticatedUserAction $action, UserArrayPresenter $userArrayPresenter)
    {
        $response = $action->execute();

        return $this->SuccessResponse($userArrayPresenter->present($response->getUser()));
    }

    public function update(
        UpdateValidationRequest $updateValidationRequest,
        UpdateProfileAction $action,
        UserArrayPresenter $userArrayPresenter
    ){
        $response = $action->execute(
            new UpdateProfileRequest(
                $updateValidationRequest->get('name'),
                $updateValidationRequest->get('last_name'),
                $updateValidationRequest->get('date_birth'),
                $updateValidationRequest->get('city'),
                $updateValidationRequest->get('university'),
                $updateValidationRequest->get('graduation_year')
            )
        );

        return $this->SuccessResponse($userArrayPresenter->present($response->getUser()));
    }

    public function uploadProfileImage(
        UploadProfileImageValidationRequest $validationRequest,
        UploadProfileImageAction $action,
        UserArrayPresenter $userArrayPresenter
    ): JsonResponse {
        $response = $action->execute(
            new UploadProfileImageRequest(
                $validationRequest->file('image')
            )
        );

        return $this->SuccessResponse($userArrayPresenter->present($response->getUser()));
    }
}

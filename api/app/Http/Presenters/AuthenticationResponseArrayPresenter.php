<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Auth\AuthenticationResponse;

final class AuthenticationResponseArrayPresenter
{
    public function present(AuthenticationResponse $response): array
    {
        $userArrayPresenter = new UserArrayPresenter;

        return [
            'user' => $userArrayPresenter->present($response->getUser()),
            'access_token' => $response->getAccessToken(),
            'token_type' => $response->getTokenType(),
            'expires_in' => $response->getExpiresIn()
        ];
    }
}

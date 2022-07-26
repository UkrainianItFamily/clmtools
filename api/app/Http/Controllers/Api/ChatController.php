<?php

namespace App\Http\Controllers\Api;

use App\Actions\Chat\AddChatAction;
use App\Actions\Chat\AddChatRequest;
use App\Http\Presenters\ChatArrayPresenter;
use App\Http\Response\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends ApiController
{
    public function store(
        Request $request,
        AddChatAction $action,
        ChatArrayPresenter $presenter
    ): JsonResponse
    {
        $response = $action->execute(
            new AddChatRequest(
                $request->get('lecture_id')
            )
        );

        return $this->successResponse($presenter->present($response->getChat()));
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Repository\ChatRepository;

final class GetChatByLectureIdAction
{
    public function __construct(private ChatRepository $chatRepository)
    {
    }

    public function execute(GetChatByLectureIdRequest $request): GetChatByLectureIdResponse
    {
        $chatRepository = $this->chatRepository;
        $chat = $chatRepository->getChatByLectureId($request->getUserId(), $request->getLectureId());

        return new GetChatByLectureIdResponse($chat);
    }
}

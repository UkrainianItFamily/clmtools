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
        return new GetChatByLectureIdResponse(
            $this->chatRepository->getChatByLectureId($request->getUserId(), $request->getLectureId())
        );
    }
}

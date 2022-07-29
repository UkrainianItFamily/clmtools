<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Repository\MessageRepository;

final class GetMessagesByLectureIdAction
{
    public function __construct(private MessageRepository $messageRepository)
    {
    }

    public function execute(GetMessagesByLectureIdRequest $request): GetMessagesByLectureIdResponse
    {
        return new GetMessagesByLectureIdResponse(
            $this->messageRepository->getMessagesByLectureId($request->getUserId(), $request->getLectureId())
        );
    }
}

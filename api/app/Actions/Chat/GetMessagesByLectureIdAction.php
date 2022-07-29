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
        $messageRepository = $this->messageRepository;
        $messages = $messageRepository->getMessagesByLectureId($request->getUserId(), $request->getLectureId());

        return new GetMessagesByLectureIdResponse($messages);
    }
}

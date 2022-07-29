<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Message;
use App\Repository\ChatRepository;
use App\Repository\MessageRepository;
use Illuminate\Support\Facades\Auth;

final class AddMessageAction
{
    public function __construct(
        private MessageRepository $messageRepository,
        private ChatRepository $chatRepository
    )
    {
    }

    public function execute(AddMessageRequest $request): AddMessageResponse
    {
        $chatRepository = $this->chatRepository;
        $chat = $chatRepository->getChatByLectureId(Auth::id(), $request->getLectureId());

        $message = new Message();
        $message->user_id = Auth::id();
        $message->chat_id = $chat->getId();
        $message->body = $request->getBody();

        $messageRepository = $this->messageRepository;
        $message = $messageRepository->save($message);

        return new AddMessageResponse($message);
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Repository\ChatRepository;
use Illuminate\Support\Facades\Auth;

final class AddChatAction
{
    public function __construct(private ChatRepository $chatRepository)
    {
    }

    public function execute(AddChatRequest $request): AddChatResponse
    {
        $chat = new Chat();
        $chat->user_id = Auth::id();
        $chat->lecture_id = $request->getLectureId();

        $chat = $this->chatRepository->save($chat);

        return new AddChatResponse($chat);
    }
}

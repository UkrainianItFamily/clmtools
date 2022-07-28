<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;

final class GetChatByLectureIdResponse
{
    public function __construct(private Chat $chat)
    {
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }
}

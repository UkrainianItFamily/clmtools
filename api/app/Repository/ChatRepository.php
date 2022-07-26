<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Chat;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class ChatRepository
{
    public function create(array $fields): Chat
    {
        return Chat::create($fields);
    }

    /**
     * @param int $id
     * @return Chat
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Chat
    {
        return Chat::findOrFail($id);
    }

    public function save(Chat $chat): Chat
    {
        $chat->save();

        return $chat;
    }
}

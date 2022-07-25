<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class MessageRepository
{
    public function create(array $fields): Message
    {
        return Message::create($fields);
    }
}

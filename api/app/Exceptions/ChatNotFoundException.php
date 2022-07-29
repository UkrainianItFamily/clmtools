<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class ChatNotFoundException extends BaseException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('chat.chat_not_found'), 401, $previous);
    }
}

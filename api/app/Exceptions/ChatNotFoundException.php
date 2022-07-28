<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class ChatNotFoundException extends BaseException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Чат не знайдено.', 401, $previous);
    }
}

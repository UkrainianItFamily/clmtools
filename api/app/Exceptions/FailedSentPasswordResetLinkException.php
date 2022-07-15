<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class FailedSentPasswordResetLinkException extends BaseException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Email could not be sent to this email address.', 400, $previous);
    }
}

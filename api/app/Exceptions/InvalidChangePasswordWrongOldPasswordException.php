<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class InvalidChangePasswordWrongOldPasswordException extends BaseException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('passwords.invalid_old_password'), 400, $previous);
    }
}

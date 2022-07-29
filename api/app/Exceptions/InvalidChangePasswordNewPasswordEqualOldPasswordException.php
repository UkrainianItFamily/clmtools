<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class InvalidChangePasswordNewPasswordEqualOldPasswordException extends BaseException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('passwords.new_password_equal_old'), 400, $previous);
    }
}

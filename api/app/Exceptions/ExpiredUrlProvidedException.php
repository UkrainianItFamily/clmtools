<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class ExpiredUrlProvidedException extends BaseException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Expired url provided.', 401, $previous);
    }
}

<?php

namespace App\Core\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
<?php


namespace App\Exceptions;


class InvalidTokenException extends \Exception
{
    public function __construct($message = null, $code = 4, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

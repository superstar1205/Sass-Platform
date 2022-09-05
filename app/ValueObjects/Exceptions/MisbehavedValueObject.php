<?php

namespace App\ValueObjects\Exceptions;

class MisbehavedValueObject extends \DomainException
{
    public static function throwIt(string $msg, $code = 503)
    {
        throw new self($msg, $code);
    }
}

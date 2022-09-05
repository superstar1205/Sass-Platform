<?php

namespace App\ValueObjects\Exceptions;

use DomainException;
use GraphQL\Error\ClientAware;

class InvalidValueObject extends DomainException implements ClientAware
{
    public static function throwIt(string $msg, $code = 503)
    {
        throw new self($msg, $code);
    }

    public function isClientSafe()
    {
        return true;
    }

    public function getCategory()
    {
        return 'business';
    }
}

<?php

namespace ArtARTs36\WeatherArchive\Exceptions;

use Throwable;

class TypeNotAvailableForCasting extends WeatherArchiveException
{
    public function __construct(string $type, $code = 0, Throwable $previous = null)
    {
        $message = "{$type} not available!";

        parent::__construct($message, $code, $previous);
    }
}

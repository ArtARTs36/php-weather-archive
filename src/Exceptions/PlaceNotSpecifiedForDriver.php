<?php

namespace ArtARTs36\WeatherArchive\Exceptions;

use ArtARTs36\WeatherArchive\Contracts\Driver;
use Throwable;

class PlaceNotSpecifiedForDriver extends WeatherArchiveException
{
    public function __construct(Driver $driver, $code = 0, Throwable $previous = null)
    {
        $message = "Place not specified for driver ". get_class($driver);

        parent::__construct($message, $code, $previous);
    }
}

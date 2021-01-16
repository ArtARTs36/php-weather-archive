<?php

namespace ArtARTs36\WeatherArchive\Entities;

use ArtARTs36\WeatherArchive\Contracts\Driver;
use ArtARTs36\WeatherArchive\Exceptions\PlaceNotSpecifiedForDriver;

class Place extends Entity implements \ArtARTs36\WeatherArchive\Contracts\Place
{
    protected $identities;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(array $identities)
    {
        $this->identities = $identities;
    }

    public function getIdentity(Driver $driver): string
    {
        if (! isset($this->identities[get_class($driver)])) {
            throw new PlaceNotSpecifiedForDriver($driver);
        }

        return $this->identities[get_class($driver)];
    }
}

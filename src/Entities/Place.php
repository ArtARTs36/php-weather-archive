<?php

namespace ArtARTs36\WeatherArchive\Entities;

class Place extends Entity implements \ArtARTs36\WeatherArchive\Contracts\Place
{
    protected $identity;

    public function __construct(string $identity)
    {
        $this->identity = $identity;
    }

    public function getIdentity(): string
    {
        return $this->identity;
    }
}

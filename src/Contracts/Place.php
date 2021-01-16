<?php

namespace ArtARTs36\WeatherArchive\Contracts;

interface Place
{
    public function getIdentity(Driver $driver): string;
}

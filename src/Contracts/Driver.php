<?php

namespace ArtARTs36\WeatherArchive\Contracts;

use ArtARTs36\WeatherArchive\Entities\Day;

interface Driver
{
    /**
     * @return Day[]
     */
    public function getOnMonth(\DateTimeInterface $date, Place $place): array;
}

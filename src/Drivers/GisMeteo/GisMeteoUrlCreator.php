<?php

namespace ArtARTs36\WeatherArchive\Drivers\GisMeteo;

use ArtARTs36\WeatherArchive\Contracts\Place;
use ArtARTs36\WeatherArchive\Contracts\UrlCreator;

class GisMeteoUrlCreator implements UrlCreator
{
    public function create(\DateTimeInterface $date, Place $place): string
    {
        return "https://www.gismeteo.ru/diary/{$place->getIdentity()}/{$this->dateToString($date)}";
    }

    protected function dateToString(\DateTimeInterface $date): string
    {
        return implode('/', [
            $date->format('Y'),
            $date->format('m'),
        ]);
    }
}
